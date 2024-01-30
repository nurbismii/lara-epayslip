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
            font-family: 'Firefly Sung';
            font-style: normal;
            font-weight: 400;
            src: url('https://eclecticgeek.com/dompdf/fonts/cjk/fireflysung.ttf') format('truetype');
        }

        * {
            font-family: Firefly Sung, DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        td {
            border: 1px;
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
                    <div class="card-body">
                        <div class="text-center">
                            <h4 class="fw-bold">PT VDNI</h4>
                            @if($cek->data_karyawan->nm_perusahaan == "VDNI")
                            <img src="{{ public_path('assets/images/logo-vdni.png') }}" style="height: 40px;" alt=""><br>
                            @endif
                            @if($cek->data_karyawan->nm_perusahaan == "VDNI-P")
                            <img src="{{ public_path('assets/images/vdnip-logo.png') }}" style="height: 30px;" alt=""><br>
                            @endif
                            <span class="fw-normal">SLIP GAJI </span> <br>
                            <span class="fw-normal">(PERIODE 16 {{ $nm_bln1 }} - 15 {{ $nm_bln }})</span>
                        </div>
                    </div>
                    <div class="card-body p-md-5">
                        <!-- Invoice table-->
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td scope="row">Nama</td>
                                        <td>{{ $cek->data_karyawan->nama }}</td>
                                        <td class="text-end">Jumlah hari kerja</td>
                                        <td class="text-end">{{ $cek->jml_hari_kerja }}</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">NIK</td>
                                        <td>{{ $cek->data_karyawan->nik }}</td>
                                        <td class="text-end">Status gaji</td>
                                        <td class="text-end">{{ $cek->status_gaji }}</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Departemen</td>
                                        <td>{{ $cek->departemen }}</td>
                                        <td class="text-end">Divisi</td>
                                        <td class="text-end">{{ $cek->posisi }}</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Posisi</td>
                                        <td>{{ $cek->divisi }}</td>
                                        <td class="text-end">Jumlah hour machine</td>
                                        <td class="text-end">{{ $cek->jml_hour_machine ?? '-' }} {{ $cek->jml_hour_machine != '' ? 'Jam' : ''}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="border-bottom">
                                    <tr class="small text-uppercase text-muted">
                                        <th class="text-start" scope="col">Detail</th>
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
                                        <td>
                                            <div class="">Tunj. Pengawas</div>
                                        </td>
                                        <td class="text-end ">Rp. {{ number_format($cek->tunj_pengawas) ?? '-' }}</td>
                                        <td class="text-end ">BPSJ Kesehatan</td>
                                        <td class="text-end ">Rp. {{ number_format($cek->pot_bpjskes) }}</td>
                                    </tr>
                                    <!-- Invoice item 4-->
                                    <tr class="">
                                        <td>
                                            <div class="">Tunj. Transportasi</div>
                                        </td>
                                        <td class="text-end ">Rp. {{ number_format($cek->tunj_transport) ?? '-' }}</td>
                                        <td class="text-end ">Deduction Unpaid Leave</td>
                                        <td class="text-end ">Rp. {{ number_format($cek->unpaid_leave) }}</td>
                                    </tr>
                                    <tr class="">
                                        <td>
                                            <div class="">Tunj. Koefisien</div>
                                        </td>
                                        <td class="text-end ">Rp. {{ number_format($cek->tunj_koefisien) }}</td>
                                        <td class="text-end">Deduction</td>
                                        <td class="text-end ">Rp. {{ number_format($cek->deduction) }}</td>
                                    </tr>
                                    <tr class="">
                                        <td>
                                            <div class="">Tunj. Masa Kerja</div>
                                        </td>
                                        <td class="text-end ">Rp. {{ number_format($cek->tunj_mk) }}</td>
                                        <td class="text-end ">Deduction PPH 21</td>
                                        <td class="text-end ">Rp. {{ number_format($cek->deduction_pph21) }}</td>
                                    </tr>
                                    <tr class="">
                                        <td>
                                            <div class="">Lembur</div>
                                        </td>
                                        <td class="text-end">Rp. {{ number_format($cek->ot) }}</td>
                                        <td class="text-end">Durasi SP</td>
                                        <td class="text-end">{{ $durasi_sp ?? "-"}}</td>
                                    </tr>
                                    <tr class="">
                                        <td>
                                            <div class="">Hour machine</div>
                                        </td>
                                        <td class="text-end">{{ $cek->jml_hour_machine ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-end pb-0" colspan="3">
                                            <div class="text-uppercase small fw-700 text-muted">Total Penghasilan:</div>
                                        </td>
                                        <td class="text-end pb-0">
                                            <div class="h6 mb-0 fw-700">Rp. {{ number_format($cek->tot_diterima) }} </div>
                                        </td>
                                    </tr>
                                    <br>
                                    <tr>
                                        <td class="pb-0">
                                            <div class="mt-2 mb-3 text-uppercase small fw-700 text-muted">Mengetahui,</div>
                                        </td>
                                    </tr>
                                    <br>
                                    <br>
                                    <tr>
                                        <td class="pb-0">
                                            <div class="mt-4 text-uppercase small fw-700 text-muted">Payroll Sistem VDNI</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>