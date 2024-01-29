<?php
$pecah = explode("-", $cek->periode);
$bulan = $pecah[1];
$kurang = $bulan - 1;
if ($kurang == "0") {
    $bln_kemarin = 12;
} else {
    $bln_kemarin = $kurang;
}
if ($bln_kemarin == "01") {
    $nm_bln1 = "JANUARI";
} else if ($bln_kemarin == "02") {
    $nm_bln1 = "FEBRUARI";
} else if ($bln_kemarin == "03") {
    $nm_bln1 = "MARET";
} else if ($bln_kemarin == "04") {
    $nm_bln1 = "APRIL";
} else if ($bln_kemarin == "05") {
    $nm_bln1 = "MEI";
} else if ($bln_kemarin == "06") {
    $nm_bln1 = "JUNI";
} else if ($bln_kemarin == "07") {
    $nm_bln1 = "JULI";
} else if ($bln_kemarin == "08") {
    $nm_bln1 = "AGUSTUS";
} else if ($bln_kemarin == "09") {
    $nm_bln1 = "SEPTEMBER";
} else if ($bln_kemarin == "10") {
    $nm_bln1 = "OKTOBER";
} else if ($bln_kemarin == "11") {
    $nm_bln1 = "NOVEMBER";
} else if ($bln_kemarin == "12") {
    $nm_bln1 = "DESEMBER";
}
$thn = $pecah[0];
if ($bulan == "01") {
    $nm_bln = "JANUARI";
} else if ($bulan == "02") {
    $nm_bln = "FEBRUARI";
} else if ($bulan == "03") {
    $nm_bln = "MARET";
} else if ($bulan == "04") {
    $nm_bln = "APRIL";
} else if ($bulan == "05") {
    $nm_bln = "MEI";
} else if ($bulan == "06") {
    $nm_bln = "JUNI";
} else if ($bulan == "07") {
    $nm_bln = "JULI";
} else if ($bulan == "08") {
    $nm_bln = "AGUSTUS";
} else if ($bulan == "09") {
    $nm_bln = "SEPTEMBER";
} else if ($bulan == "10") {
    $nm_bln = "OKTOBER";
} else if ($bulan == "11") {
    $nm_bln = "NOVEMBER";
} else if ($bulan == "12") {
    $nm_bln = "DESEMBER";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta charset="utf-8" /> -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="E PaySlip" />
    <meta name="author" content="HR SITE" />
    <title>Slip Gaji</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        @font-face {
            font-family: SimHei;
            src: url('{{base_path().' /public/'}}fonts/simhei.ttf') format('truetype');
        }

        * {
            font-family: SimHei;
        }
    </style>
</head>

<body class="nav-fixed">
    <div id="layoutSidenav">
        <main>
            <!-- Main page content-->
            <div class="container-xl px-1">
                <!-- Invoice-->
                <div class="card invoice">
                    <div class="text-center">
                        <h4 class="fw-bold">PT VDNI</h4>
                        @if($cek->data_karyawan->nm_perusahaan == "VDNI")
                        <img src="{{ public_path('assets/images/logo-vdni.png') }}" style="height: 40px;" alt=""><br>
                        @endif
                        @if($cek->data_karyawan->nm_perusahaan == "VDNI-P")
                        <img src="{{ public_path('assets/images/vdnip-logo.png') }}" style="height: 30px;" alt=""><br>
                        @endif
                        <span class="fw-normal">SLIP GAJI </span> <br>
                        <span class="fw-normal"> Periode (PERIODE 21 {{ $nm_bln1 }} - 20 {{ $nm_bln }})</span>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <!-- Invoice table-->
                        <div class="table-responsive">
                            <table class="table table-borderless mb-3">
                                <tbody>
                                    <tr>
                                        <td scope="row">Nama</td>
                                        <td>{{ $cek->data_karyawan->nama }}</td>
                                        <td>Jumlah hari kerja</td>
                                        <td>{{ $cek->jml_hari_kerja }}</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">NIK</td>
                                        <td>{{ $cek->data_karyawan->nik }}</td>
                                        <td>Status gaji</td>
                                        <td>{{ $cek->status_gaji }}</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Departemen</td>
                                        <td>{{ $cek->departemen }}</td>
                                        <td>Divisi</td>
                                        <td>{{ $cek->posisi }}</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Posisi</td>
                                        <td>{{ $cek->divisi }}</td>
                                        <td>Jumlah hour machine</td>
                                        <td>{{ $cek->jml_hour_machine }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="border-bottom">
                                    <tr class="small text-uppercase text-muted">
                                        <th scope="col">Detail</th>
                                        <th class="text-end" scope="col">Jumlah</th>
                                        <th class="text-end" scope="col">Deduction</th>
                                        <th class="text-end" scope="col">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="">
                                        @if($cek->gaji_pokok > 0)
                                        <td>
                                            <div class="">Gaji pokok</div>
                                        </td>
                                        <td class="text-end">Rp.{{ number_format($cek->gaji_pokok) }}</td>
                                        @else
                                        <td></td>
                                        <td></td>
                                        @endif
                                        @if($cek->jht > 0)
                                        <td class="text-end ">BPJS TK JHT</td>
                                        <td class="text-end ">Rp.{{ number_format($cek->jht) }}</td>
                                        @endif
                                    </tr>
                                    <!-- Invoice item 2-->
                                    <tr class="">
                                        @if($cek->tunj_um > 0)
                                        <td>
                                            <div class="">Tunj. Uang Makan</div>
                                        </td>
                                        <td class="text-end ">Rp. {{ number_format($cek->tunj_um) }}</td>
                                        @else
                                        <td></td>
                                        <td></td>
                                        @endif
                                        @if($cek->jp > 0)
                                        <td class="text-end ">BPJS TK JP</td>
                                        <td class="text-end ">Rp. {{ number_format($cek->jp) }}</td>
                                        @endif
                                    </tr>
                                    <!-- Invoice item 3-->
                                    <tr class="">
                                        @if($cek->tunj_pengawas > 0)
                                        <td>
                                            <div class="">Tunj. Pengawas</div>
                                        </td>
                                        <td class="text-end ">Rp. {{ number_format($cek->tunj_pengawas) }}</td>
                                        @else
                                        <td></td>
                                        <td></td>
                                        @endif
                                        @if($cek->pot_bpjskes > 0)
                                        <td class="text-end ">BPSJ Kesehatan</td>
                                        <td class="text-end ">Rp. {{ number_format($cek->pot_bpjskes) }}</td>
                                        @endif
                                    </tr>
                                    <!-- Invoice item 4-->
                                    <tr class="">
                                        @if($cek->tunj_transport > 0)
                                        <td>
                                            <div class="">Tunj. Transportasi</div>
                                        </td>
                                        <td class="text-end ">Rp. {{ number_format($cek->tunj_transport) }}</td>
                                        @else
                                        <td></td>
                                        <td></td>
                                        @endif
                                        @if($cek->unpaid_leave > 0)
                                        <td class="text-end ">Deduction Unpaid Leave</td>
                                        <td class="text-end ">Rp. {{ number_format($cek->unpaid_leave) }}</td>
                                        @endif
                                    </tr>
                                    <tr class="">
                                        @if($cek->tunj_koefisien > 0)
                                        <td>
                                            <div class="">Tunj. Koefisien</div>
                                        </td>
                                        <td class="text-end ">Rp. {{ number_format($cek->tunj_koefisien) }}</td>
                                        @else
                                        <td></td>
                                        <td></td>
                                        @endif
                                    </tr>
                                    <tr class="">
                                        @if($cek->tunj_mk > 0)
                                        <td>
                                            <div class="">Tunj. Masa Kerja</div>
                                        </td>
                                        <td class="text-end ">Rp. {{ number_format($cek->tunj_mk) }}</td>
                                        @else
                                        <td></td>
                                        <td></td>
                                        @endif
                                        @if($cek->deduction > 0)
                                        <td class="text-end ">Deduction</td>
                                        <td class="text-end ">Rp. {{ number_format($cek->deduction) }}</td>
                                        @endif
                                    </tr>
                                    <tr class="">
                                        @if($cek->ot > 0)
                                        <td>
                                            <div class="">Lembur</div>
                                        </td>
                                        <td class="text-end">Rp. {{ number_format($cek->ot) }}</td>
                                        @else
                                        <td></td>
                                        <td></td>
                                        @endif
                                        @if($cek->deduction_pph21 > 0)
                                        <td class="text-end ">Deduction PPH 21</td>
                                        <td class="text-end ">Rp. {{ number_format($cek->deduction_pph21) }}</td>
                                        @endif
                                    </tr>
                                    <tr class="">
                                        @if($cek->jml_hour_machine > 0)
                                        <td>
                                            <div class="">Hour machine</div>
                                        </td>
                                        <td class="text-end">{{ $cek->jml_hour_machine }}</td>
                                        @else
                                        <td></td>
                                        <td></td>
                                        @endif
                                        @if($cek->durasi_sp != "1970-01-01")
                                        <td class="text-end">Durasi SP</td>
                                        <td class="text-end">{{ $durasi_sp ?? "-"}}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="text-end pb-0" colspan="3">
                                            <div class="text-uppercase small fw-700 text-muted">Total Penghasilan:</div>
                                        </td>
                                        <td class="text-end pb-0">
                                            <div class="h5 mb-0 fw-700">Rp. {{ number_format($cek->tot_diterima) }} </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-left">
                        <p class="mb-5 mx-4">Mengetahui,</p> <br> <br>
                        <p class="mt-3 mx-4">Payroll Sistem VDNi</p>
                    </div>

                </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>