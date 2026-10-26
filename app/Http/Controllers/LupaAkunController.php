<?php

namespace App\Http\Controllers;

use App\Mail\LupaAkunEmail;
use App\Models\LupaAkun;
use App\Models\LupaPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LupaAkunController extends Controller
{
    public function index()
    {
        return view('lupa_akun.index');
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'nik' => ['required', 'string', 'max:255'],
            'tgl_lahir' => ['required', 'date_format:Y-m-d', 'before:today'],
            'no_ktp' => ['required', 'string', 'digits:16'],
            'email' => ['required', 'email', 'max:255'],
        ]);
        $email = Str::lower($input['email']);

        try {
            DB::transaction(function () use ($input, $email) {
                $user = User::where('level', 'Pengguna')
                    ->whereHas('karyawan', function ($query) use ($input) {
                        $query->where('nik', $input['nik'])
                            ->where('tgl_lahir', $input['tgl_lahir'])
                            ->where('no_ktp', $input['no_ktp']);
                    })->lockForUpdate()->first();

                if (!$user) {
                    Log::info('lupa_akun.skipped', ['reason' => 'identity_not_found']);
                    return;
                }
                if (!$this->canRecover($user)) {
                    Log::info('lupa_akun.skipped', ['reason' => 'account_not_recoverable']);
                    return;
                }
                if (User::whereRaw('LOWER(email) = ?', [$email])->exists()) {
                    Log::info('lupa_akun.skipped', ['reason' => 'new_email_already_registered']);
                    return;
                }

                $existing = LupaAkun::where('user_id', $user->id)->first();
                if ($existing && $existing->expires_at->isFuture()) {
                    Log::info('lupa_akun.skipped', ['reason' => 'recovery_pending']);
                    return;
                }

                $token = Str::random(64);
                LupaAkun::updateOrCreate(['user_id' => $user->id], [
                    'email' => $email,
                    'token' => hash('sha256', $token),
                    'account_hash' => $this->accountHash($user),
                    'expires_at' => now()->addMinutes(60),
                ]);

                Mail::to($email)->send(new LupaAkunEmail(route('lupa_akun.reset', $token)));
                Log::info('lupa_akun.mail_processed');
            });
        } catch (\Throwable $exception) {
            report($exception);
            return back()->withErrors(['email' => 'Permintaan belum dapat diproses. Silakan coba lagi nanti.']);
        }

        // Respons seragam mencegah pemeriksaan identitas dan email milik karyawan lain.
        return redirect()->route('lupa_akun.index')->with('status',
            'Jika data sesuai dan email baru belum digunakan, tautan pemulihan dikirim ke email baru Anda. Periksa inbox atau spam. Tautan berlaku 60 menit; permintaan ulang dapat dilakukan setelah itu.');
    }

    public function reset(string $token)
    {
        $recovery = $this->recovery($token);
        $this->validateAccount($recovery, $recovery->user);

        return response()->view('lupa_akun.reset', compact('recovery', 'token'))
            ->header('Cache-Control', 'no-store, private')
            ->header('Referrer-Policy', 'no-referrer');
    }

    public function update(Request $request, string $token)
    {
        $input = $request->validate([
            // Bcrypt membatasi panjang dalam byte, termasuk untuk kata sandi Unicode.
            'password' => ['required', 'string', 'min:8', 'max:72', 'regex:/\A[^\x00]{1,72}\z/', 'confirmed'],
        ], ['password.regex' => 'Kata sandi terlalu panjang atau mengandung karakter yang tidak didukung.']);

        DB::transaction(function () use ($token, $input) {
            $recovery = $this->recovery($token);
            $user = User::whereKey($recovery->user_id)->lockForUpdate()->firstOrFail();
            $recovery = $this->recovery($token, true);
            $this->validateAccount($recovery, $user);

            if (User::whereRaw('LOWER(email) = ?', [$recovery->email])->exists()) {
                throw ValidationException::withMessages([
                    'email' => 'Email baru sudah digunakan. Silakan ajukan pemulihan lagi dengan email lain setelah tautan kedaluwarsa.',
                ]);
            }

            Password::broker()->deleteToken($user);
            LupaPassword::where('user_id', $user->id)->update(['status' => 'Tidak Aktif']);
            $user->tokens()->delete();
            $user->forceFill([
                'email' => $recovery->email,
                'password' => Hash::make($input['password']),
                'email_verified_at' => now(),
                'status' => 'Aktif',
                'token' => '',
                'remember_token' => Str::random(60),
                'account_recovery_version' => $user->account_recovery_version + 1,
            ])->save();
            $recovery->delete();
        });

        return redirect()->route('login')->with('status',
            'Email dan kata sandi berhasil diperbarui. Silakan masuk dengan email baru Anda.');
    }

    private function recovery(string $token, bool $lock = false): LupaAkun
    {
        abort_unless(preg_match('/\A[a-zA-Z0-9]{64}\z/', $token), 404);
        $query = LupaAkun::where('token', hash('sha256', $token))->where('expires_at', '>', now());

        return ($lock ? $query->lockForUpdate() : $query)->firstOrFail();
    }

    private function validateAccount(LupaAkun $recovery, ?User $user): void
    {
        abort_unless($user && $this->canRecover($user)
            && hash_equals($recovery->account_hash, $this->accountHash($user)), 404);
    }

    private function canRecover(User $user): bool
    {
        return $user->level === 'Pengguna' && ($user->status === 'Aktif'
            || ($user->status === 'Tidak Aktif' && !empty($user->token) && !$user->email_verified_at));
    }

    private function accountHash(User $user): string
    {
        return hash('sha256', json_encode($user->only([
            'email', 'password', 'token', 'status', 'level', 'data_karyawan_id', 'account_recovery_version',
        ]), JSON_THROW_ON_ERROR));
    }
}
