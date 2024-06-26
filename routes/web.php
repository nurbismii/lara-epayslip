<?php

use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => 'is_active'], function () {

  Route::get('/upload-salary', [App\Http\Controllers\SalaryController::class, 'uploadSalary']);
  Route::get('/salary/detail/{id}', [App\Http\Controllers\SalaryController::class, 'show'])->name('detail.salary');

  Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/{id}/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/{id}/destroy', [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('/nonaktifkan-pengguna', [UserController::class, 'nonaktifkan_pengguna'])->name('nonaktifkan_pengguna');
  });

  Route::get('api/pengguna', [App\Http\Controllers\PenggunaController::class, 'api'])->name('api.pengguna');
  Route::resource('pengguna', '\App\Http\Controllers\PenggunaController');

  Route::group(['prefix' => 'karyawan'], function () {
    Route::get('/', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::get('/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
    Route::patch('/{id}/update', [KaryawanController::class, 'update'])->name('karyawan.update');
    Route::get('/{id}/destroy', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');
    Route::get('/{id}/show', [KaryawanController::class, 'show'])->name('karyawan.show');
    Route::post('/upload', [KaryawanController::class, 'upload'])->name('karyawan.upload');
    Route::post('/upload/update', [KaryawanController::class, 'perubahan'])->name('perubahan');
    Route::post('/upload/destroy', [KaryawanController::class, 'hapus_karyawan'])->name('hapus_karyawan');
  });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('is_active');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/masa-kerja', [App\Http\Controllers\HomeController::class, 'masaKerja'])->name('masaKerja')->middleware('is_admin');
Route::get('api/masa-kerja', [App\Http\Controllers\HomeController::class, 'fetchMasaKerja'])->middleware('is_admin');
Route::get('api/karyawan', [App\Http\Controllers\KaryawanController::class, 'api'])->name('api.karyawan')->middleware('is_admin');

Route::resource('salary', '\App\Http\Controllers\SalaryController')->middleware('is_admin');
Route::get('api/salary', [App\Http\Controllers\SalaryController::class, 'api'])->name('api.salary')->middleware('is_admin');
Route::post('upload/salary', [App\Http\Controllers\SalaryController::class, 'upload'])->name('salary.upload')->middleware('is_admin');
Route::post('search/salary', [App\Http\Controllers\SalaryController::class, 'search'])->name('salary.search')->middleware('is_admin');

Route::get('akun-saya', [App\Http\Controllers\SettingController::class, 'my_account'])->name('pengguna.akun')->middleware('is_active');
Route::patch('update-akun/{id}', [App\Http\Controllers\SettingController::class, 'update'])->name('update.akun')->middleware('is_active');
Route::post('proses-pendaftaran',  [App\Http\Controllers\PendaftaranController::class, 'pendaftaran'])->name('pendaftaran');
Route::get('pendaftaran/verifikasi/{id}', [App\Http\Controllers\PendaftaranController::class, 'verifikasi'])->name('pendaftaran.verifikasi');
Route::get('profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile')->middleware('is_active');
Route::get('slip-gaji', [App\Http\Controllers\SlipGajiController::class, 'index'])->name('slip_gaji')->middleware('is_active');
Route::post('slip-gaji/cari', [App\Http\Controllers\SlipGajiController::class, 'search'])->name('search.slip_gaji')->middleware('is_active');
Route::post('/slip-gaji/cetak_pdf', [App\Http\Controllers\SlipGajiController::class, 'cetak_pdf'])->name('cetak.slip_gaji')->middleware('is_active');

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

Route::resource('pencapaian-kinerja', 'App\Http\Controllers\PenilaianKinerjaController')->middleware('is_admin');
Route::resource('evaluasi-ketangakerjaan', 'App\Http\Controllers\EvaluasiKetenagakerjaanController')->middleware('is_admin');
Route::resource('hasil-evaluasi', 'App\Http\Controllers\HasilEvaluasiController')->middleware('is_admin');
Route::get('detail-pencapaian-kinerja',  [App\Http\Controllers\PenilaianKinerjaController::class, 'detail_penilaian_kinerja'])->name('detail_penilaian')->middleware('is_active');
Route::get('detail-evaluasi-ketenagakerjaan',  [App\Http\Controllers\EvaluasiKetenagakerjaanController::class, 'detail_evaluasi'])->name('detail_evaluasi')->middleware('is_active');
Route::get('detail-hasil-evaluasi', [App\Http\Controllers\HasilEvaluasiController::class, 'detail_hasil_evaluasi'])->name('detail_hasil_evaluasi')->middleware('is_active');
