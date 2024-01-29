<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('is_active');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('is_active');
Route::resource('karyawan', '\App\Http\Controllers\KaryawanController')->middleware('is_admin');
Route::get('api/karyawan', [App\Http\Controllers\KaryawanController::class, 'api'])->name('api.karyawan')->middleware('is_admin');
Route::post('upload/karyawan', [App\Http\Controllers\KaryawanController::class, 'upload'])->name('karyawan.upload')->middleware('is_admin');
Route::resource('salary', '\App\Http\Controllers\SalaryController')->middleware('is_admin');
Route::get('api/salary', [App\Http\Controllers\SalaryController::class, 'api'])->name('api.salary')->middleware('is_admin');
Route::post('upload/salary', [App\Http\Controllers\SalaryController::class, 'upload'])->name('salary.upload')->middleware('is_admin');
Route::post('search/salary', [App\Http\Controllers\SalaryController::class, 'search'])->name('salary.search')->middleware('is_admin');
Route::get('api/pengguna', [App\Http\Controllers\PenggunaController::class, 'api'])->name('api.pengguna')->middleware('is_admin');
Route::resource('pengguna', '\App\Http\Controllers\PenggunaController')->middleware('is_admin');
Route::get('akun-saya', [App\Http\Controllers\SettingController::class, 'my_account'])->name('pengguna.akun')->middleware('is_active');
Route::patch('update-akun/{id}', [App\Http\Controllers\SettingController::class, 'update'])->name('update.akun')->middleware('is_active');
Route::post('proses-pendaftaran',  [App\Http\Controllers\PendaftaranController::class, 'pendaftaran'])->name('pendaftaran');
Route::get('pendaftaran/verifikasi/{id}', [App\Http\Controllers\PendaftaranController::class, 'verifikasi'])->name('pendaftaran.verifikasi');
Route::get('profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile')->middleware('is_active');
Route::get('slip-gaji', [App\Http\Controllers\SlipGajiController::class, 'index'])->name('slip_gaji')->middleware('is_active');
Route::post('slip-gaji/cari', [App\Http\Controllers\SlipGajiController::class, 'search'])->name('search.slip_gaji')->middleware('is_active');
Route::post('/slip-gaji/cetak_pdf', [App\Http\Controllers\SlipGajiController::class, 'cetak_pdf'])->name('cetak.slip_gaji')->middleware('is_active');
Route::resource('user', '\App\Http\Controllers\UserController')->middleware('is_admin');
Route::get('api/user', [App\Http\Controllers\UserController::class, 'api'])->name('api.user')->middleware('is_admin');
Route::get('lupa-password', [App\Http\Controllers\LupaPasswordController::class, 'index'])->name('forget');
Route::post('store-forget', [App\Http\Controllers\LupaPasswordController::class, 'store'])->name('store.forget');
Route::get('konfirmasi/reset/{id}', [App\Http\Controllers\LupaPasswordController::class, 'konfirmasi'])->name('konfirmasi.reset');
Route::patch('update-password/{id}', [App\Http\Controllers\LupaPasswordController::class, 'update_password'])->name('update.password');
Route::post('/salary/cetak_pdf', [App\Http\Controllers\SalaryController::class, 'hasil_pdf'])->name('salary.cetak_pdf')->middleware('is_admin');
Route::post('/salary/delete-all', [App\Http\Controllers\SalaryController::class, 'delete_all'])->name('salary.delete_all')->middleware('is_admin');
Route::post('/karyawan/delete-all', [App\Http\Controllers\KaryawanController::class, 'delete_all'])->name('karyawan.delete_all')->middleware('is_admin');
Route::get('resend-email', [App\Http\Controllers\ResendEmailController::class, 'index'])->name('resend_email');
Route::post('store-resend', [App\Http\Controllers\ResendEmailController::class, 'store'])->name('store.resend_email');
Route::get('data-tertolak', [App\Http\Controllers\FailUploadKomponenController::class, 'index'])->name('data_tertolak')->middleware('is_admin');
Route::resource('info-pengumuman', '\App\Http\Controllers\InfoPengumumanController')->middleware('is_admin');
Route::get('api/pengumuman', [App\Http\Controllers\InfoPengumumanController::class, 'api'])->name('api.pengumuman')->middleware('is_admin');
Route::post('perubahan-data', [App\Http\Controllers\KaryawanController::class, 'perubahan'])->name('perubahan')->middleware('is_admin');
Route::post('hapus-karyawan', [App\Http\Controllers\KaryawanController::class, 'hapus_karyawan'])->name('hapus_karyawan')->middleware('is_admin');
Route::post('nonaktifkan-pengguna', [App\Http\Controllers\UserController::class, 'nonaktifkan_pengguna'])->name('nonaktifkan_pengguna')->middleware('is_admin');
Route::resource('pencapaian-kinerja', 'App\Http\Controllers\PenilaianKinerjaController')->middleware('is_admin');
Route::resource('evaluasi-ketangakerjaan', 'App\Http\Controllers\EvaluasiKetenagakerjaanController')->middleware('is_admin');
Route::resource('hasil-evaluasi', 'App\Http\Controllers\HasilEvaluasiController')->middleware('is_admin');
Route::get('detail-pencapaian-kinerja',  [App\Http\Controllers\PenilaianKinerjaController::class, 'detail_penilaian_kinerja'])->name('detail_penilaian')->middleware('is_active');
Route::get('detail-evaluasi-ketenagakerjaan',  [App\Http\Controllers\EvaluasiKetenagakerjaanController::class, 'detail_evaluasi'])->name('detail_evaluasi')->middleware('is_active');
Route::get('detail-hasil-evaluasi', [App\Http\Controllers\HasilEvaluasiController::class, 'detail_hasil_evaluasi'])->name('detail_hasil_evaluasi')->middleware('is_active');
