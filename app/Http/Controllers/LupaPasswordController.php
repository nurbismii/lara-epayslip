<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LupaPassword;
use App\Models\LupaAkun;
use App\Mail\LupaPasswordEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Support\Alert;

class LupaPasswordController extends Controller
{
    public function index()
    {
        return view('forget_password.index');
    }

    public function store(Request $request)
    {
        $request->validate(['email' => ['required', 'email', 'max:255']]);
        $email = $request->email;
        $token = Str::random(32);
        $cek = User::whereRaw('LOWER(email) = ?', [Str::lower($email)])
            ->where('status', 'Aktif')->where('level', 'Pengguna')->first();
        if ($cek == null) {
            Alert::error('Error', 'Email tidak terdaftar pada sistem kami, terimakasih :)');
            return redirect()->route('forget');
        }
        $email = $cek->email;

        $exist_req_forget = LupaPassword::where('user_id', $cek->id)->latest()->first();

        if ($exist_req_forget && $exist_req_forget->created_at->gt(now()->subHour())) {
            // Jika kurang dari 1 jam, berikan respon
            Alert::error('Error', 'Oops, tunggu 1 jam kedepan untuk melakukan request ini lagi. Terimakasih');
            return redirect()->route('forget');
        } else {
            try {
                DB::transaction(function () use ($cek, $email, $token) {
                    $user = User::whereKey($cek->id)->lockForUpdate()->firstOrFail();
                    abort_unless($user->email === $email && $user->status === 'Aktif'
                        && $user->level === 'Pengguna', 404);
                    LupaPassword::where('user_id', $user->id)->update(['status' => 'Tidak Aktif']);
                    LupaPassword::create([
                        'user_id' => $user->id,
                        'token' => $token,
                        'status' => 'Aktif',
                    ]);
                    Mail::to($email)->send(new LupaPasswordEmail(['nama' => $user->name, 'token' => $token]));
                });
                Alert::success('Sukses', 'Reset kata sandi berhasil silahkan cek inbox email kamu, terimakasih');
                return redirect()->route('login');
            } catch (\Throwable $e) {
                report($e);
                Alert::error('Error', 'Terjadi kesalahan pada saat melakukan permintaan, coba lagi nanti :)');
                return redirect()->route('forget');
            }
        }
    }

    public function konfirmasi($id)
    {
        $cek = LupaPassword::where('token', $id)->where('status', 'Aktif')
            ->where('created_at', '>', now()->subHour())->first();

        if ($cek == null) {
            return view('email.failed');
        }

        return view('forget_password.reset', compact('cek'));
    }

    public function update_password(Request $request, $id)
    {
        $input = $request->validate([
            'token' => ['required', 'string', 'size:32'],
            'id_lupa' => ['required', 'integer'],
            'password' => ['required', 'string', 'min:8', 'max:72', 'regex:/\A[^\x00]{1,72}\z/'],
            'confirm_password' => ['required', 'same:password'],
        ], ['password.regex' => 'Kata sandi terlalu panjang atau mengandung karakter yang tidak didukung.']);

        DB::transaction(function () use ($input, $id) {
            $user = User::whereKey($id)->where('level', 'Pengguna')
                ->where('status', 'Aktif')->lockForUpdate()->firstOrFail();
            LupaPassword::whereKey($input['id_lupa'])->where('user_id', $user->id)
                ->where('token', $input['token'])->where('status', 'Aktif')
                ->where('created_at', '>', now()->subHour())->lockForUpdate()->firstOrFail();

            Password::broker()->deleteToken($user);
            LupaPassword::where('user_id', $user->id)->update(['status' => 'Tidak Aktif']);
            LupaAkun::where('user_id', $user->id)->delete();
            $user->tokens()->delete();
            $user->forceFill([
                'password' => Hash::make($input['password']),
                'remember_token' => Str::random(60),
                'account_recovery_version' => $user->account_recovery_version + 1,
            ])->save();
        });

        Alert::success('Sukses', 'Password Telah Berhasil Di Reset');
        return redirect()->route('login');
    }
}
