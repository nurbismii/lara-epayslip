<?php

use App\Models\KomponenGaji;
use Illuminate\Support\Facades\DB;

function getTanggalIndo($tanggal)
{
  if (isset($tanggal)) {
    $bulan = array(
      1 =>   'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
  }
  return '';
}

function getDataPayroll($tahun)
{
  // Ambil total gaji per bulan langsung dari DB
  $rows = \App\Models\KomponenGaji::selectRaw("
            LEFT(periode, 4) as tahun,
            RIGHT(periode, 2) as bulan,
            SUM(gaji_pokok) as total_gaji
        ")
    ->where('periode', 'like', "$tahun%")
    ->groupBy('tahun', 'bulan')
    ->orderBy('bulan')
    ->get();

  // Siapkan array 12 bulan (0 di bulan yang tidak ada data)
  $payroll_chart = array_fill(0, 12, 0);

  foreach ($rows as $row) {
    $index = (int)$row->bulan - 1; // ubah ke index array (0–11)
    $payroll_chart[$index] = (int)$row->total_gaji;
  }

  return $payroll_chart;
}

function getPersentase($data, $data_baru)
{
  $persentase_all = [];

  for ($i = 0; $i < 12; $i++) {
    if ($data_baru[$i] > 0) {
      $persentase_all[] = (($data_baru[$i] - $data[$i]) / $data[$i]) * 100;
    } else {
      $persentase_all[] = 0;
    }
  }

  return $persentase_all;
}

function getSelisih($data, $data_baru)
{
  $persentase_all = [];

  for ($i = 0; $i < 12; $i++) {
    if ($data_baru[$i] > 0) {
      $persentase_all[] = $data_baru[$i] - $data[$i];
    } else {
      $persentase_all[] = 0;
    }
  }
  return $persentase_all;
}

function konversiNumber($number)
{
  $number = abs($number);

  if ($number >= 1000000000) {
    $miliar = floor($number / 1000000000);
    $sisa = $number % 1000000000;
    $juta = floor($sisa / 1000000);
    return $miliar . ' M ' . $juta . ' JT';
  } elseif ($number >= 1000000) {
    $juta = floor($number / 1000000);
    $sisa = $number % 1000000;
    $ribu = floor($sisa / 1000);
    return $juta . ' JT ' . $ribu . ' Rb';
  } elseif ($number >= 1000) {
    $ribu = floor($number / 1000);
    $sisa = $number % 1000;
    return $ribu . ' Rb ' . $sisa;
  }
  return $number;
}

function getTotalKaryawan($tahun)
{
  $rows = \App\Models\KomponenGaji::selectRaw("
            LEFT(periode, 4) as tahun,
            RIGHT(periode, 2) as bulan,
            COUNT(*) as total_karyawan
        ")
    ->where('periode', 'like', "$tahun%")
    ->groupBy('tahun', 'bulan')
    ->orderBy('bulan')
    ->get();

  // Inisialisasi array 12 bulan (nilai awal 0)
  $months = array_fill(0, 12, 0);

  foreach ($rows as $row) {
    $index = (int)$row->bulan - 1;
    $months[$index] = (int)$row->total_karyawan;
  }

  return $months;
}

function persenSelisihKaryawan($total_karyawan, $total_karyawan_tahun_lalu)
{
  $persentase_all = [];

  // Menghitung panjang terkecil antara kedua array untuk menghindari Undefined offset
  $length = min(count($total_karyawan), count($total_karyawan_tahun_lalu));

  for ($i = 0; $i < 12; $i++) {
    // Memastikan indeks tidak melebihi panjang terkecil dari kedua array
    if ($i < $length && $total_karyawan_tahun_lalu[$i] > 0) {
      $persentase_all[] = (($total_karyawan[$i] - $total_karyawan_tahun_lalu[$i]) / $total_karyawan_tahun_lalu[$i]) * 100;
    } else {
      $persentase_all[] = 0;
    }
  }

  return $persentase_all;
}

function selisihKaryawan($total_karyawan, $total_karyawan_tahun_lalu)
{
  $persentase_all = [];

  for ($i = 0; $i < 12; $i++) {
    if ($total_karyawan[$i] > 0) {
      $persentase_all[] = $total_karyawan[$i] - $total_karyawan_tahun_lalu[$i];
    } else {
      $persentase_all[] = 0;
    }
  }
  return $persentase_all;
}

function rerataUpah($total_bayar, $total_karyawan)
{
  $rerata_upah = [];

  for ($i = 0; $i < 12; $i++) {
    if ($total_bayar[$i] > 0) {
      $rerata_upah[] = $total_bayar[$i] / $total_karyawan[$i];
    } else {
      $rerata_upah[] = 0;
    }
  }
  return $rerata_upah;
}

function jumlahKaryawanGrupByMasaKerja($data)
{
  $count = [];

  foreach ($data as $d) {
    $count[] = $d->count;
  }
  return $count;
}

function totalBayarGrupByMasaKerja($data)
{
  $count = [];

  foreach ($data as $d) {
    $count[] = $d->total_tunj_mk;
  }

  return $count;
}

function labelKaryawanGrupByMasaKerja($data)
{
  $count = [];

  foreach ($data as $d) {
    $count[] = $d->years_worked . ' Tahun';
  }
  return $count;
}

function fetchMasaKerjaByPeriode($periode)
{
  return  KomponenGaji::where('periode', $periode)
    ->select('periode', DB::raw('FLOOR(tunj_mk / 50000) as years_worked'), DB::raw('COUNT(*) as count'), DB::raw('SUM(tunj_mk) as total_tunj_mk'))
    ->groupBy('periode', 'years_worked')
    ->having('years_worked', '>=', 1)
    ->get();
}

function fetchSumMasaKerjaByPeriode($periode)
{
  $grand_total = [];

  $data = KomponenGaji::where('periode', $periode)
    ->select('periode', DB::raw('COUNT(*) as count'), DB::raw('SUM(tunj_mk) as total_tunj_mk'))
    ->groupBy('periode')
    ->get();

  foreach ($data as $row) {
    $grand_total[] = $row->total_tunj_mk;
  }

  return $grand_total;
}

function persentase($data, $data_lama)
{
  $persen = [];

  $length = min(count($data), count($data_lama));

  for ($i = 0; $i < $length; $i++) {
    if ($data_lama[$i] > 0) {
      $persen[] = (($data[$i] - $data_lama[$i]) / $data_lama[$i]) * 100;
    } else {
      $persen[] = 0;
    }
  }

  return $persen;
}

function fetchBpjsTkByPeriode($periode)
{
  return KomponenGaji::where('periode', $periode)
    ->select('periode', DB::raw('COUNT(*) as count'), DB::raw('SUM(jht) as total_jht'))
    ->groupBy('periode')
    ->get();
}

function jumlahPembayaranJht($data)
{
  $count = [];

  foreach ($data as $d) {
    $count[] = $d->total_jht;
  }
  return $count;
}

function jumlahKaryawanJht($data)
{
  $count = [];

  foreach ($data as $d) {
    $count[] = $d->count;
  }
  return $count;
}
