<?php

use App\Http\Controllers\{
  HomeController,
  SalaryController,
  UserController,
  PenggunaController,
  KaryawanController,
  SettingController,
  PendaftaranController,
  ProfileController,
  SlipGajiController,
  LupaPasswordController,
  ResendEmailController,
  FailUploadKomponenController,
  InfoPengumumanController,
  PenilaianKinerjaController,
  EvaluasiKetenagakerjaanController,
  HasilEvaluasiController
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('is_active')->group(function () {
  Route::get('/upload-salary', [SalaryController::class, 'uploadSalary']);
  Route::get('/salary/detail/{id}', [SalaryController::class, 'show'])->name('detail.salary');

  Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/{id}/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/{id}/destroy', [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('/nonaktifkan-pengguna', [UserController::class, 'nonaktifkan_pengguna'])->name('nonaktifkan_pengguna');
  });

  Route::prefix('karyawan')->group(function () {
    Route::get('/', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::get('/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
    Route::patch('/{id}/update', [KaryawanController::class, 'update'])->name('karyawan.update');
    Route::get('/{id}/destroy', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');
    Route::get('/{id}/show', [KaryawanController::class, 'show'])->name('karyawan.show');
    Route::post('/upload', [KaryawanController::class, 'upload'])->name('karyawan.upload');
    Route::post('/upload/update', [KaryawanController::class, 'perubahan'])->name('perubahan');
    Route::post('/upload/destroy', [KaryawanController::class, 'hapus_karyawan'])->name('hapus_karyawan');
  });

  Route::get('akun-saya', [SettingController::class, 'my_account'])->name('pengguna.akun');
  Route::patch('update-akun/{id}', [SettingController::class, 'update'])->name('update.akun');
  Route::get('profile', [ProfileController::class, 'index'])->name('profile');

  Route::prefix('slip-gaji')->group(function () {
    Route::get('/', [SlipGajiController::class, 'index'])->name('slip_gaji');
    Route::post('/cari', [SlipGajiController::class, 'search'])->name('search.slip_gaji');
    Route::get('/cetak_pdf/{periode}', [SlipGajiController::class, 'cetak_pdf'])->name('cetak.slip_gaji');
  });

  Route::get('detail-pencapaian-kinerja',  [PenilaianKinerjaController::class, 'detail_penilaian_kinerja'])->name('detail_penilaian');
  Route::get('detail-evaluasi-ketenagakerjaan',  [EvaluasiKetenagakerjaanController::class, 'detail_evaluasi'])->name('detail_evaluasi');
  Route::get('detail-hasil-evaluasi', [HasilEvaluasiController::class, 'detail_hasil_evaluasi'])->name('detail_hasil_evaluasi');
});

Route::middleware('is_admin')->group(function () {
  Route::get('/masa-kerja', [HomeController::class, 'masaKerja'])->name('masaKerja');
  Route::get('/bpjs-tk', [HomeController::class, 'BPJSTK'])->name('bpjs-tk');

  Route::get('api/masa-kerja', [HomeController::class, 'fetchMasaKerja']);
  Route::get('api/karyawan', [KaryawanController::class, 'api'])->name('api.karyawan');
  Route::get('api/salary', [SalaryController::class, 'api'])->name('api.salary');
  Route::get('api/pengumuman', [InfoPengumumanController::class, 'api'])->name('api.pengumuman');
  Route::get('api/pengguna', [PenggunaController::class, 'api'])->name('api.pengguna');

  Route::resource('salary', SalaryController::class);
  Route::post('upload/salary', [SalaryController::class, 'upload'])->name('salary.upload');
  Route::post('search/salary', [SalaryController::class, 'search'])->name('salary.search');
  Route::post('/salary/cetak_pdf', [SalaryController::class, 'hasil_pdf'])->name('salary.cetak_pdf');
  Route::post('/salary/delete-all', [SalaryController::class, 'delete_all'])->name('salary.delete_all');

  Route::post('/karyawan/delete-all', [KaryawanController::class, 'delete_all'])->name('karyawan.delete_all');
  Route::resource('pengguna', PenggunaController::class);
  Route::resource('info-pengumuman', InfoPengumumanController::class);
  Route::resource('pencapaian-kinerja', PenilaianKinerjaController::class);
  Route::resource('evaluasi-ketangakerjaan', EvaluasiKetenagakerjaanController::class);
  Route::resource('hasil-evaluasi', HasilEvaluasiController::class);
  Route::get('data-tertolak', [FailUploadKomponenController::class, 'index'])->name('data_tertolak');
  Route::get('export/karyawan', [KaryawanController::class, 'exportKaryawan'])->name('export.karyawan');
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('is_active');

Route::get('lupa-password', [LupaPasswordController::class, 'index'])->name('forget');
Route::post('store-forget', [LupaPasswordController::class, 'store'])->name('store.forget');
Route::get('konfirmasi/reset/{id}', [LupaPasswordController::class, 'konfirmasi'])->name('konfirmasi.reset');
Route::patch('update-password/{id}', [LupaPasswordController::class, 'update_password'])->name('update.password');

Route::get('resend-email', [ResendEmailController::class, 'index'])->name('resend_email');
Route::post('store-resend', [ResendEmailController::class, 'store'])->name('store.resend_email');

Route::post('proses-pendaftaran',  [PendaftaranController::class, 'pendaftaran'])->name('pendaftaran');
Route::get('pendaftaran/verifikasi/{id}', [PendaftaranController::class, 'verifikasi'])->name('pendaftaran.verifikasi');
