<?php
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
  $jan = [];
  $feb = [];
  $maret = [];
  $april = [];
  $mei = [];
  $juni = [];
  $juli = [];
  $agust = [];
  $sept = [];
  $okt = [];
  $nov = [];
  $dec = [];
  $payroll_chart = '';

  foreach ($data as $d) {
    $validation[] = date('Y', strtotime($d->periode));
  }

  foreach ($data as $d) {
    $payroll_record[] = [
      'bulan' => date('m', strtotime($d->periode)),
      'tot_diterima' => $d->tot_diterima
    ];
  }

  for ($i = 0; $i < count($payroll_record); $i++) :

    if ($validation[$i] == $waktu) :
      if ($payroll_record[$i]['bulan'] == '01') {
        $jan[] = $payroll_record[$i]['tot_diterima'];
      }

      if ($payroll_record[$i]['bulan'] == '02') {
        $feb[] = $payroll_record[$i]['tot_diterima'];
      }

      if ($payroll_record[$i]['bulan'] == '03') {
        $maret[] = $payroll_record[$i]['tot_diterima'];
      }

      if ($payroll_record[$i]['bulan'] == '04') {
        $april[] = $payroll_record[$i]['tot_diterima'];
      }

      if ($payroll_record[$i]['bulan'] == '05') {
        $mei[] = $payroll_record[$i]['tot_diterima'];
      }

      if ($payroll_record[$i]['bulan'] == '06') {
        $juni[] = $payroll_record[$i]['tot_diterima'];
      }

      if ($payroll_record[$i]['bulan'] == '07') {
        $juli[] = $payroll_record[$i]['tot_diterima'];
      }

      if ($payroll_record[$i]['bulan'] == '08') {
        $agust[] = $payroll_record[$i]['tot_diterima'];
      }

      if ($payroll_record[$i]['bulan'] == '09') {
        $sept[] = $payroll_record[$i]['tot_diterima'];
      }

      if ($payroll_record[$i]['bulan'] == '10') {
        $okt[] = $payroll_record[$i]['tot_diterima'];
      }

      if ($payroll_record[$i]['bulan'] == '11') {
        $nov[] = $payroll_record[$i]['tot_diterima'];
      }

      if ($payroll_record[$i]['bulan'] == '12') {
        $dec[] = $payroll_record[$i]['tot_diterima'];
      }
    endif;
  endfor;

  if (count($payroll_record) > 0) {
    $payroll_chart = [
      array_sum(array_filter($jan)),
      array_sum(array_filter($feb)),
      array_sum(array_filter($maret)),
      array_sum(array_filter($april)),
      array_sum(array_filter($mei)),
      array_sum(array_filter($juni)),
      array_sum(array_filter($juli)),
      array_sum(array_filter($agust)),
      array_sum(array_filter($sept)),
      array_sum(array_filter($okt)),
      array_sum(array_filter($nov)),
      array_sum(array_filter($dec))
    ];
  }

  return $payroll_chart;
}

function getPersentase($data, $data_baru)
{
  $jan = $data[0];
  $feb = $data[1];
  $mar = $data[2];
  $apr = $data[3];
  $mei = $data[4];
  $jun = $data[5];
  $jul = $data[6];
  $agu = $data[7];
  $sep = $data[8];
  $okt = $data[9];
  $nov = $data[10];
  $des = $data[11];

  $jan_baru = $data_baru[0];
  $feb_baru = $data_baru[1];
  $mar_baru = $data_baru[2];
  $apr_baru = $data_baru[3];
  $mei_baru = $data_baru[4];
  $jun_baru = $data_baru[5];
  $jul_baru = $data_baru[6];
  $agu_baru = $data_baru[7];
  $sep_baru = $data_baru[8];
  $okt_baru = $data_baru[9];
  $nov_baru = $data_baru[10];
  $des_baru = $data_baru[11];

  if ($jan_baru > 0) {
    $persentase_jan = ($jan_baru - $jan) / $jan * 100;
  } else {
    $persentase_jan = 0;
  }

  if ($feb_baru > 0) {
    $persentase_feb = ($feb_baru - $feb) / $feb * 100;
  } else {
    $persentase_feb = 0;
  }

  if ($mar_baru > 0) {
    $persentase_mar = ($mar_baru - $mar) / $mar * 100;
  } else {
    $persentase_mar = 0;
  }

  if ($apr_baru > 0) {
    $persentase_apr = ($apr_baru - $apr) / $apr * 100;
  } else {
    $persentase_apr = 0;
  }

  if ($mei_baru > 0) {
    $persentase_mei = ($mei_baru - $mei) / $mei * 100;
  } else {
    $persentase_mei = 0;
  }

  if ($jun_baru > 0) {
    $persentase_jun = ($jun_baru - $jun) / $jun * 100;
  } else {
    $persentase_jun = 0;
  }

  if ($jul_baru > 0) {
    $persentase_jul = ($jul_baru - $jul) / $jul * 100;
  } else {
    $persentase_jul = 0;
  }

  if ($agu_baru > 0) {
    $persentase_agu = ($agu_baru - $agu) / $agu * 100;
  } else {
    $persentase_agu = 0;
  }

  if ($sep_baru > 0) {
    $persentase_sep = ($sep_baru - $sep) / $sep * 100;
  } else {
    $persentase_sep = 0;
  }

  if ($okt_baru > 0) {
    $persentase_okt = ($okt_baru - $okt) / $okt * 100;
  } else {
    $persentase_okt = 0;
  }

  if ($nov_baru > 0) {
    $persentase_nov = ($nov_baru - $nov) / $nov * 100;
  } else {
    $persentase_nov = 0;
  }

  if ($des_baru > 0) {
    $persentase_des = ($des_baru - $des) / $des * 100;
  } else {
    $persentase_des = 0;
  }

  $persentase_all = [
    $persentase_jan,
    $persentase_feb,
    $persentase_mar,
    $persentase_apr,
    $persentase_mei,
    $persentase_jun,
    $persentase_jul,
    $persentase_agu,
    $persentase_okt,
    $persentase_sep,
    $persentase_nov,
    $persentase_des
  ];

  return $persentase_all;
}

function getSelisih($data, $data_baru)
{
  $jan = $data[0];
  $feb = $data[1];
  $mar = $data[2];
  $apr = $data[3];
  $mei = $data[4];
  $jun = $data[5];
  $jul = $data[6];
  $agu = $data[7];
  $sep = $data[8];
  $okt = $data[9];
  $nov = $data[10];
  $des = $data[11];

  $jan_baru = $data_baru[0];
  $feb_baru = $data_baru[1];
  $mar_baru = $data_baru[2];
  $apr_baru = $data_baru[3];
  $mei_baru = $data_baru[4];
  $jun_baru = $data_baru[5];
  $jul_baru = $data_baru[6];
  $agu_baru = $data_baru[7];
  $sep_baru = $data_baru[8];
  $okt_baru = $data_baru[9];
  $nov_baru = $data_baru[10];
  $des_baru = $data_baru[11];

  if ($jan_baru > 0) {
    $persentase_jan = $jan_baru - $jan;
  } else {
    $persentase_jan = 0;
  }

  if ($feb_baru > 0) {
    $persentase_feb = $feb_baru - $feb;
  } else {
    $persentase_feb = 0;
  }

  if ($mar_baru > 0) {
    $persentase_mar = $mar_baru - $mar;
  } else {
    $persentase_mar = 0;
  }

  if ($apr_baru > 0) {
    $persentase_apr = $apr_baru - $apr;
  } else {
    $persentase_apr = 0;
  }

  if ($mei_baru > 0) {
    $persentase_mei = $mei_baru - $mei;
  } else {
    $persentase_mei = 0;
  }

  if ($jun_baru > 0) {
    $persentase_jun = $jun_baru - $jun;
  } else {
    $persentase_jun = 0;
  }

  if ($jul_baru > 0) {
    $persentase_jul = $jul_baru - $jul;
  } else {
    $persentase_jul = 0;
  }

  if ($agu_baru > 0) {
    $persentase_agu = $agu_baru - $agu;
  } else {
    $persentase_agu = 0;
  }

  if ($sep_baru > 0) {
    $persentase_sep = $sep_baru - $sep;
  } else {
    $persentase_sep = 0;
  }

  if ($okt_baru > 0) {
    $persentase_okt = $okt_baru - $okt;
  } else {
    $persentase_okt = 0;
  }

  if ($nov_baru > 0) {
    $persentase_nov = $nov_baru - $nov;
  } else {
    $persentase_nov = 0;
  }

  if ($des_baru > 0) {
    $persentase_des = $des_baru - $des;
  } else {
    $persentase_des = 0;
  }

  $persentase_all = [
    $persentase_jan,
    $persentase_feb,
    $persentase_mar,
    $persentase_apr,
    $persentase_mei,
    $persentase_jun,
    $persentase_jul,
    $persentase_agu,
    $persentase_okt,
    $persentase_sep,
    $persentase_nov,
    $persentase_des
  ];

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
