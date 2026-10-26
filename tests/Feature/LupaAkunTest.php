<?php

namespace Tests\Feature;

use App\Mail\LupaAkunEmail;
use App\Mail\LupaPasswordEmail;
use App\Mail\RegisterEmail;
use App\Models\DataKaryawan;
use App\Models\LupaAkun;
use App\Models\LupaPassword;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class LupaAkunTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');
        // Hanya migrasi autentikasi pada SQLite sementara; database aplikasi tidak disentuh.
        $this->artisan('migrate', ['--path' => [
            'database/migrations/2014_10_12_000000_create_users_table.php',
            'database/migrations/2014_10_12_100000_create_password_resets_table.php',
            'database/migrations/2019_12_14_000001_create_personal_access_tokens_table.php',
            'database/migrations/2021_09_12_133921_add_level_and_status.php',
            'database/migrations/2021_09_13_033056_create_data_karyawans_table.php',
            'database/migrations/2021_09_14_022915_add_token_id.php',
            'database/migrations/2021_09_15_055405_create_lupa_passwords_table.php',
            'database/migrations/2026_10_26_000000_create_lupa_akuns_table.php',
        ]])->assertSuccessful();
        Mail::fake();
    }

    private function employee(array $attributes = []): User
    {
        $employee = DataKaryawan::forceCreate([
            'nik' => 'TEST-001', 'no_ktp' => '0123456789012345', 'nama' => 'Karyawan Uji',
            'departemen' => 'Uji', 'divisi' => 'Uji', 'posisi' => 'Uji', 'tgl_lahir' => '1990-02-03',
        ]);

        return User::forceCreate(array_merge([
            'name' => $employee->nama, 'email' => 'lama@example.test',
            'password' => Hash::make('PasswordLama123'), 'data_karyawan_id' => $employee->id,
            'level' => 'Pengguna', 'status' => 'Aktif', 'token' => '', 'email_verified_at' => now(),
            'remember_token' => Str::random(60),
        ], $attributes));
    }

    private function input(array $changes = []): array
    {
        return array_merge([
            'nik' => 'TEST-001', 'tgl_lahir' => '1990-02-03',
            'no_ktp' => '0123456789012345', 'email' => 'baru@example.test',
        ], $changes);
    }

    private function requestRecovery(array $changes = []): string
    {
        $this->post(route('lupa_akun.store'), $this->input($changes))
            ->assertRedirect(route('lupa_akun.index'))->assertSessionHasNoErrors();

        return Mail::sent(LupaAkunEmail::class)->last()->url;
    }

    private function password(array $changes = []): array
    {
        return array_merge(['password' => 'PasswordBaru123', 'password_confirmation' => 'PasswordBaru123'], $changes);
    }

    public function test_forms_offer_both_recovery_options(): void
    {
        $this->get('/login')->assertOk()->assertSee(route('forget'))->assertSee(route('lupa_akun.index'));
        $this->get(route('forget'))->assertOk()->assertSee(route('lupa_akun.index'));
        $this->get(route('lupa_akun.index'))->assertOk()->assertSee('No. KTP')->assertSee('Tanggal Lahir');
    }

    public static function recoverableAccounts(): array
    {
        return [
            'verified' => [['status' => 'Aktif', 'token' => '', 'email_verified_at' => '2026-01-01 00:00:00']],
            'legacy verified' => [['status' => 'Aktif', 'token' => '', 'email_verified_at' => null]],
            'unverified' => [['status' => 'Tidak Aktif', 'token' => 'registration-token', 'email_verified_at' => null]],
        ];
    }

    #[DataProvider('recoverableAccounts')]
    public function test_recovery_verifies_new_email_without_creating_another_account(array $attributes): void
    {
        $user = $this->employee($attributes);
        $oldPassword = $user->password;
        $oldRememberToken = $user->remember_token;
        $oldReset = LupaPassword::create(['user_id' => $user->id, 'token' => Str::random(32), 'status' => 'Aktif']);
        $apiToken = $user->tokens()->create(['name' => 'old-device', 'token' => hash('sha256', Str::random(40)), 'abilities' => ['*']]);
        DB::table('password_resets')->insert(['email' => $user->email, 'token' => 'old-token', 'created_at' => now()]);

        $url = $this->requestRecovery(['email' => 'BARU@example.test']);
        $recovery = LupaAkun::firstOrFail();
        $token = basename(parse_url($url, PHP_URL_PATH));
        $this->assertSame(hash('sha256', $token), $recovery->token);
        $this->assertNotSame($token, $recovery->token);
        $this->assertSame('lama@example.test', $user->fresh()->email);
        $this->assertSame($oldPassword, $user->fresh()->password);
        Mail::assertSent(LupaAkunEmail::class, function ($mail) {
            $this->assertStringContainsString('60 menit', $mail->render());
            return $mail->hasTo('baru@example.test');
        });

        $this->get($url)->assertOk()->assertSee('baru@example.test')
            ->assertDontSee('lama@example.test')->assertHeader('Referrer-Policy', 'no-referrer');
        $this->post($url, $this->password())->assertRedirect(route('login'))->assertSessionHasNoErrors();
        $this->get(route('login'))->assertSee('Email dan kata sandi berhasil diperbarui.');
        $user->refresh();
        $this->assertSame('baru@example.test', $user->email);
        $this->assertSame('Aktif', $user->status);
        $this->assertSame('', $user->token);
        $this->assertNotNull($user->email_verified_at);
        $this->assertTrue(Hash::check('PasswordBaru123', $user->password));
        $this->assertNotSame($oldRememberToken, $user->remember_token);
        $this->assertSame(1, (int) $user->account_recovery_version);
        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'data_karyawan_id' => $user->data_karyawan_id]);
        $this->assertDatabaseCount('lupa_akuns', 0);
        $this->assertSame('Tidak Aktif', $oldReset->fresh()->status);
        $this->assertDatabaseCount('password_resets', 0);
        $this->assertDatabaseMissing('personal_access_tokens', ['id' => $apiToken->id]);
        $this->get($url)->assertNotFound();
        $this->post($url, $this->password())->assertNotFound();
        $this->post('/login', ['email' => 'lama@example.test', 'password' => 'PasswordLama123'])->assertSessionHasErrors('email');
        $this->post('/login', ['email' => 'baru@example.test', 'password' => 'PasswordBaru123'])->assertSessionHasNoErrors();
        $this->assertAuthenticatedAs($user);
        $this->get(route('lupa_akun.index'))->assertOk();
    }

    public static function invalidIdentities(): array
    {
        return [
            'unknown nik' => [['nik' => 'UNKNOWN']],
            'wrong birthday' => [['tgl_lahir' => '1990-02-04']],
            'wrong ktp' => [['no_ktp' => '9999999999999999']],
            'existing email' => [['email' => 'LAMA@example.test']],
            'administrator' => [[], ['level' => 'Administrator']],
            'disabled verified' => [[], ['status' => 'Tidak Aktif', 'token' => '']],
            'disabled legacy verified' => [[], ['status' => 'Tidak Aktif', 'token' => '', 'email_verified_at' => null]],
        ];
    }

    #[DataProvider('invalidIdentities')]
    public function test_invalid_identity_and_ineligible_accounts_receive_the_same_response(array $input, array $attributes = []): void
    {
        $user = $this->employee($attributes);
        $this->post(route('lupa_akun.store'), $this->input($input))
            ->assertRedirect(route('lupa_akun.index'))->assertSessionHas('status', fn ($value) => str_starts_with($value, 'Jika data sesuai'));
        Mail::assertNothingSent();
        $this->assertDatabaseCount('lupa_akuns', 0);
        $this->assertSame('lama@example.test', $user->fresh()->email);
        $this->assertTrue(Hash::check('PasswordLama123', $user->fresh()->password));
    }

    public function test_pending_request_does_not_replace_a_live_link_and_can_be_reissued_after_expiry(): void
    {
        $this->employee();
        $url = $this->requestRecovery();
        $this->post(route('lupa_akun.store'), $this->input(['email' => 'lain@example.test']))->assertSessionHasNoErrors();
        Mail::assertSentCount(1);
        $this->get($url)->assertOk();
        $this->travel(61)->minutes();
        $this->get($url)->assertNotFound();
        $this->post($url, $this->password())->assertNotFound();
        $newUrl = $this->requestRecovery(['email' => 'lain@example.test']);
        $this->assertNotSame($url, $newUrl);
        $this->get($url)->assertNotFound();
        $this->get($newUrl)->assertOk()->assertSee('lain@example.test');
        $this->assertDatabaseCount('lupa_akuns', 1);
    }

    public static function changedAccounts(): array
    {
        return [
            'password' => [['password' => 'changed-password-hash']],
            'email' => [['email' => 'changed@example.test']],
            'disabled' => [['status' => 'Tidak Aktif']],
            'promoted' => [['level' => 'Administrator']],
            'registration verified' => [['token' => 'different-registration-token']],
        ];
    }

    #[DataProvider('changedAccounts')]
    public function test_changing_the_account_invalidates_a_previously_issued_link(array $changes): void
    {
        $user = $this->employee();
        $url = $this->requestRecovery();
        $user->forceFill($changes)->save();
        $this->get($url)->assertNotFound();
        $this->post($url, $this->password())->assertNotFound();
        $this->assertSame($changes, $user->fresh()->only(array_keys($changes)));
    }

    public function test_email_claimed_before_completion_does_not_overwrite_either_account(): void
    {
        $user = $this->employee();
        $url = $this->requestRecovery();
        User::forceCreate(['name' => 'Pengguna Lain', 'email' => 'baru@example.test', 'password' => 'other-hash', 'level' => 'Pengguna', 'status' => 'Aktif', 'token' => '']);
        $this->from($url)->post($url, $this->password())->assertSessionHasErrors('email');
        $this->assertSame('lama@example.test', $user->fresh()->email);
        $this->assertTrue(Hash::check('PasswordLama123', $user->fresh()->password));
        $this->assertDatabaseHas('users', ['email' => 'baru@example.test', 'password' => 'other-hash']);
    }

    public function test_validation_rejects_malformed_input_and_never_flashes_ktp_or_password(): void
    {
        $this->employee();
        $this->from(route('lupa_akun.index'))->post(route('lupa_akun.store'), $this->input(['email' => 'invalid']))
            ->assertSessionHasErrors('email')->assertSessionMissing('_old_input.no_ktp');
        $this->post(route('lupa_akun.store'), ['nik' => [], 'email' => [], 'no_ktp' => [], 'tgl_lahir' => 'invalid'])
            ->assertSessionHasErrors(['nik', 'email', 'no_ktp', 'tgl_lahir']);
        $this->post(route('lupa_akun.store'), $this->input(['no_ktp' => '123']))->assertSessionHasErrors('no_ktp');
        $url = $this->requestRecovery();
        $this->from($url)->post($url, $this->password(['password' => 'short', 'password_confirmation' => 'different']))
            ->assertSessionHasErrors('password')->assertSessionMissing('_old_input.password')->assertSessionMissing('_old_input.password_confirmation');
        $this->assertDatabaseHas('users', ['email' => 'lama@example.test']);
        $this->get(route('lupa_akun.reset', Str::random(64)))->assertNotFound();
        $this->post(route('lupa_akun.update', 'invalid-token'), $this->password())->assertNotFound();
    }

    public function test_mail_failure_rolls_back_request_and_preserves_the_account(): void
    {
        $user = $this->employee();
        Mail::shouldReceive('to')->once()->with('baru@example.test')->andThrow(new \RuntimeException('Simulated mail failure'));
        $this->from(route('lupa_akun.index'))->post(route('lupa_akun.store'), $this->input())->assertSessionHasErrors('email');
        $this->assertDatabaseCount('lupa_akuns', 0);
        $this->assertSame('lama@example.test', $user->fresh()->email);
        $this->assertTrue(Hash::check('PasswordLama123', $user->fresh()->password));
    }

    public function test_passwords_support_unicode_within_bcrypt_limits_and_reject_null_bytes(): void
    {
        $user = $this->employee();
        $url = $this->requestRecovery();
        foreach ([str_repeat('界', 25), "Password\0Baru123"] as $password) {
            $this->post($url, ['password' => $password, 'password_confirmation' => $password])->assertSessionHasErrors('password');
        }
        $password = '密码Baru123';
        $this->post($url, ['password' => $password, 'password_confirmation' => $password])->assertRedirect(route('login'))->assertSessionHasNoErrors();
        $this->assertTrue(Hash::check($password, $user->fresh()->password));
    }

    public function test_remember_cookie_created_after_recovery_can_start_a_new_session(): void
    {
        $user = $this->employee(['account_recovery_version' => 1]);
        $this->post('/login', ['email' => $user->email, 'password' => 'PasswordLama123', 'remember' => true])->assertSessionHasNoErrors();
        $cookieName = Auth::guard()->getRecallerName();
        $user->refresh();
        $cookie = implode('|', [$user->id, $user->remember_token, Auth::guard()->hashPasswordForCookie($user->password)]);
        session()->flush();
        Auth::forgetGuards();

        $this->withCookie($cookieName, $cookie)->get(route('lupa_akun.index'))->assertOk();
        $this->assertAuthenticatedAs($user);
        $this->assertSame(1, session('account_recovery_version'));
    }

    public function test_attempts_are_limited_per_ip_and_per_employee_across_ips(): void
    {
        $this->employee();
        for ($attempt = 1; $attempt <= 5; $attempt++) {
            $this->withServerVariables(['REMOTE_ADDR' => '192.0.2.' . $attempt])
                ->post(route('lupa_akun.store'), $this->input(['no_ktp' => '9999999999999999']))->assertRedirect();
        }
        $this->withServerVariables(['REMOTE_ADDR' => '192.0.2.6'])->post(route('lupa_akun.store'), $this->input())->assertStatus(429);
        Mail::assertNothingSent();
        for ($attempt = 1; $attempt <= 5; $attempt++) {
            $this->withServerVariables(['REMOTE_ADDR' => '192.0.2.99'])
                ->post(route('lupa_akun.store'), $this->input(['nik' => 'WRONG-' . $attempt, 'email' => 'wrong' . $attempt . '@example.test']))->assertRedirect();
        }
        $this->post(route('lupa_akun.store'), $this->input(['nik' => 'WRONG-6', 'email' => 'wrong6@example.test']))->assertStatus(429);
    }

    public function test_old_sessions_are_rejected_and_a_new_login_is_accepted(): void
    {
        $user = $this->employee();
        $url = $this->requestRecovery();
        $this->actingAs($user)->withSession(['account_recovery_version' => 0]);
        $this->post($url, $this->password())->assertRedirect(route('login'));
        // Seperti request baru: guard mengambil versi akun terbaru dari database.
        $this->actingAs($user->fresh());
        $this->get(route('lupa_akun.index'))->assertRedirect(route('login'));
        $this->assertGuest();
        $this->post('/login', ['email' => 'baru@example.test', 'password' => 'PasswordBaru123'])->assertSessionHasNoErrors();
        $this->get(route('lupa_akun.index'))->assertOk();
        $this->assertAuthenticated();
    }

    public function test_forgot_password_still_works_and_invalidates_account_recovery_links(): void
    {
        $user = $this->employee();
        $url = $this->requestRecovery();
        $this->post(route('store.forget'), ['email' => Str::upper($user->email)])->assertRedirect(route('login'));
        Mail::assertSent(LupaPasswordEmail::class);
        $reset = LupaPassword::firstOrFail();
        $this->get(route('konfirmasi.reset', $reset->token))->assertOk();
        $payload = ['token' => $reset->token, 'id_lupa' => $reset->id, 'password' => 'PasswordBaru123', 'confirm_password' => 'PasswordBaru123'];
        $this->patch(route('update.password', $user->id), array_merge($payload, ['token' => Str::random(32)]))->assertNotFound();
        $this->patch(route('update.password', $user->id), $payload)->assertRedirect(route('login'));
        $this->assertSame('lama@example.test', $user->fresh()->email);
        $this->assertTrue(Hash::check('PasswordBaru123', $user->fresh()->password));
        $this->patch(route('update.password', $user->id), $payload)->assertNotFound();
        $this->get($url)->assertNotFound();
    }

    public function test_old_password_reset_requires_the_matching_user_and_a_live_token(): void
    {
        $user = $this->employee();
        $reset = LupaPassword::create(['user_id' => $user->id, 'token' => Str::random(32), 'status' => 'Aktif']);
        $payload = ['token' => $reset->token, 'id_lupa' => $reset->id, 'password' => 'PasswordBaru123', 'confirm_password' => 'PasswordBaru123'];
        $other = User::forceCreate(['name' => 'Lain', 'email' => 'lain@example.test', 'password' => 'other-hash', 'level' => 'Pengguna', 'status' => 'Aktif', 'token' => '']);
        $this->patch(route('update.password', $other->id), $payload)->assertNotFound();
        $this->travel(61)->minutes();
        $this->patch(route('update.password', $user->id), $payload)->assertNotFound();
        $this->assertTrue(Hash::check('PasswordLama123', $user->fresh()->password));
        $this->assertSame('other-hash', $other->fresh()->password);
    }

    public function test_admin_deactivation_cannot_be_undone_by_resending_registration_email(): void
    {
        $user = $this->employee(['status' => 'Tidak Aktif', 'token' => 'registration-token', 'email_verified_at' => null]);
        $admin = User::forceCreate(['name' => 'Admin', 'email' => 'admin@example.test', 'password' => 'admin-hash', 'level' => 'Administrator', 'status' => 'Aktif', 'token' => '']);
        $this->actingAs($admin)->patch(route('user.update', $user->id), ['status' => 'Tidak Aktif'])->assertRedirect('user');
        $this->assertSame('', $user->fresh()->token);
        $this->post(route('store.resend_email'), ['email' => $user->email])->assertRedirect(route('login'));
        Mail::assertNothingSent();
        $this->assertSame('', $user->fresh()->token);
        $this->post(route('lupa_akun.store'), $this->input())->assertSessionHasNoErrors();
        Mail::assertNothingSent();
    }

    public function test_pending_registration_can_still_resend_and_verify_its_original_email(): void
    {
        // Tabel lama ini belum memiliki migrasi di repositori.
        Schema::create('resend_emails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->dateTime('waktu');
            $table->timestamps();
        });
        $user = $this->employee(['status' => 'Tidak Aktif', 'token' => Str::random(32), 'email_verified_at' => null]);
        $url = $this->requestRecovery();
        $this->post(route('store.resend_email'), ['email' => $user->email])->assertRedirect(route('login'));
        Mail::assertSent(RegisterEmail::class, fn ($mail) => $mail->hasTo($user->email) && $mail->data['token'] === $user->token);
        $this->get(route('pendaftaran.verifikasi', $user->token))->assertOk();
        $this->assertSame('Aktif', $user->fresh()->status);
        $this->assertNotNull($user->fresh()->email_verified_at);
        $this->get($url)->assertNotFound();
    }
}
