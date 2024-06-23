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

function getDataPayroll($data, $waktu)
{
  $payroll_record = [];
  $validation = [];
  $months = array_fill(0, 12, []);

  // Ekstraksi dan validasi data
  foreach ($data as $d) {
    $validation[] = date('Y', strtotime($d->periode));
    $payroll_record[] = [
      'bulan' => date('m', strtotime($d->periode)),
      'gaji_pokok' => $d->gaji_pokok
    ];
  }

  // Memasukkan data ke array bulanan
  foreach ($payroll_record as $i => $record) {
    if ($validation[$i] == $waktu) {
      $month_index = (int)$record['bulan'] - 1; // Konversi bulan ke indeks array (0-11)
      $months[$month_index][] = (int)$record['gaji_pokok'];
    }
  }

  // Menghitung total per bulan dan membuat payroll_chart
  $payroll_chart = array_map(function ($month_data) {
    return array_sum(array_filter($month_data));
  }, $months);

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

function getTotalKaryawan($data, $waktu)
{
  $payroll_record = [];
  $validation = [];
  $months = array_fill(0, 12, 0);

  // Ekstraksi dan validasi data
  foreach ($data as $d) {
    $validation[] = date('Y', strtotime($d->periode));
    $payroll_record[] = [
      'bulan' => date('m', strtotime($d->periode)),
    ];
  }

  // Memasukkan data ke array bulanan
  foreach ($payroll_record as $i => $record) {
    if ($validation[$i] == $waktu) {
      $month_index = (int)$record['bulan'] - 1; // Konversi bulan ke indeks array (0-11)
      $months[$month_index] += 1;
    }
  }
  return $months;
}

function persenSelisihKaryawan($total_karyawan, $total_karyawan_tahun_lalu)
{
  $persentase_all = [];

  for ($i = 0; $i < 12; $i++) {
    if ($total_karyawan[$i] > 0) {
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

