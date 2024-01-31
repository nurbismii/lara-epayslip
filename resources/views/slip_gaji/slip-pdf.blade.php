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

        .td.bet {
            border: 1px;
        }

        .row-bet {
            margin-left: -5px;
            margin-right: -5px;
        }

        .column-bet {
            float: left;
            width: 50%;
            padding: 5px;
        }

        /* Clearfix (clear floats) */
        .row-bet::after {
            content: "";
            clear: both;
            display: table;
        }

        .table-custom {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        .td-bet {
            text-align: left;
            padding: 16px;
        }

        /* Tata letak responsif - membuat dua kolom bertumpuk, bukan bersebelahan pada layar yang lebih kecil dari 600 piksel */
        @media screen and (max-width: 600px) {
            .column-bet {
                width: 100%;
            }
        }
    </style>
</head>

<body class="nav-fixed">
    <div id="layoutSidenav">
        <main>
            <div class="container-xl px-1">
                <!-- Invoice-->
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
                                    <td width="20px">:</td>
                                    <td>{{ $cek->data_karyawan->nama }}</td>
                                    <td class="">Jumlah hari kerja</td>
                                    <td>:</td>
                                    <td class="text-end">{{ $cek->jml_hari_kerja }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">NIK</td>
                                    <td width="20px">:</td>
                                    <td>{{ $cek->data_karyawan->nik }}</td>
                                    <td class="">Status gaji</td>
                                    <td width="20px">:</td>
                                    <td class="text-end">{{ $cek->status_gaji }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Departemen</td>
                                    <td width="20px">:</td>
                                    <td>{{ $cek->departemen }}</td>
                                    <td class="">Divisi</td>
                                    <td width="20px">:</td>
                                    <td class="text-end">{{ $cek->posisi }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Posisi</td>
                                    <td width="20px">:</td>
                                    <td>{{ $cek->divisi }}</td>
                                    <td class="">Jumlah hour machine</td>
                                    <td width="20px">:</td>
                                    <td class="text-end">{{ $cek->jml_hour_machine ?? '-' }} {{ $cek->jml_hour_machine != '' ? 'Jam' : ''}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row-bet">
                        <div class="column-bet">
                            <table class="table mb-0">
                                <thead class="border-bottom">
                                    <tr class="small text-uppercase text-muted">
                                        <th width="100px" class="text-start" scope="col">Detail</th>
                                        <th></th>
                                        <th width="150" class="text-start" scope="col">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="">
                                        @if($cek->gaji_pokok > 0)
                                        <td>
                                            <div class="">Gaji pokok</div>
                                        </td>
                                        <td width="20px">:</td>
                                        <td class="">Rp.{{ number_format($cek->gaji_pokok) }}</td>
                                        @endif
                                    </tr>
                                    <!-- Invoice item 2-->
                                    <tr class="">
                                        @if($cek->tunj_um > 0)
                                        <td>
                                            <div class="">Tunj. Uang Makan</div>
                                        </td>
                                        <td width="20px">:</td>
                                        <td class="">Rp. {{ number_format($cek->tunj_um) }}</td>
                                        @endif
                                    </tr>
                                    <!-- Invoice item 3-->
                                    <tr class="">
                                        @if($cek->tunj_pengawas > 0)
                                        <td>
                                            <div class="">Tunj. Pengawas</div>
                                        </td>
                                        <td width="20px">:</td>
                                        <td class="">Rp. {{ number_format($cek->tunj_pengawas) }}</td>
                                        @endif
                                    </tr>
                                    <!-- Invoice item 4-->
                                    <tr class="">
                                        @if($cek->tunj_transport > 0)
                                        <td>
                                            <div class="">Tunj. Transportasi</div>
                                        </td>
                                        <td width="20px">:</td>
                                        <td class="">Rp. {{ number_format($cek->tunj_transport) ?? '-' }}</td>
                                        @endif
                                    </tr>
                                    <tr class="">
                                        @if($cek->tunj_koefisien > 0)
                                        <td>
                                            <div class="">Tunj. Koefisien</div>
                                        </td>
                                        <td width="20px">:</td>
                                        <td class="">Rp. {{ number_format($cek->tunj_koefisien) }}</td>
                                        @endif
                                    </tr>
                                    <tr class="">
                                        @if($cek->tunj_mk > 0)
                                        <td>
                                            <div class="">Tunj. Masa Kerja</div>
                                        </td>
                                        <td width="20px">:</td>
                                        <td class="">Rp. {{ number_format($cek->tunj_mk) }}</td>
                                        @endif
                                    </tr>
                                    <tr class="">
                                        @if($cek->ot > 0)
                                        <td>
                                            <div class="">Lembur</div>
                                        </td>
                                        <td width="20px">:</td>
                                        <td class="">Rp. {{ number_format($cek->ot) }}</td>
                                        @endif
                                    </tr>
                                    <tr class="">
                                        @if($cek->jml_hour_machine > 0)
                                        <td>
                                            <div class="">Hour machine</div>
                                        </td>
                                        <td width="20px">:</td>
                                        <td class="">{{ $cek->jml_hour_machine ?? '-' }}</td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="column-bet">
                            <table class="table mb-0">
                                <thead class="border-bottom">
                                    <tr class="small text-uppercase text-muted">
                                        <th width="100px" class="text-start" scope="col">Detail</th>
                                        <th></th>
                                        <th width="150px" class="text-start" scope="col">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="">
                                        @if($cek->jht > 0)
                                        <td class="">BPJS TK JHT</td>
                                        <td width="20px">:</td>
                                        <td class="">Rp.{{ number_format($cek->jht) }}</td>
                                        @endif
                                    </tr>
                                    <!-- Invoice item 2-->
                                    <tr class="">
                                        @if($cek->jp > 0)
                                        <td class="">BPJS TK JP</td>
                                        <td width="20px">:</td>
                                        <td class="">Rp. {{ number_format($cek->jp) }}</td>
                                        @endif
                                    </tr>
                                    <!-- Invoice item 3-->
                                    <tr class="">
                                        @if($cek->pot_bpjskes > 0)
                                        <td class="">BPSJ Kesehatan</td>
                                        <td width="20px">:</td>
                                        <td class="">Rp. {{ number_format($cek->pot_bpjskes) }}</td>
                                        @endif
                                    </tr>
                                    <!-- Invoice item 4-->
                                    <tr class="">
                                        @if($cek->tunj_transport > 0)
                                        <td>
                                            <div class="">Tunj. Transportasi</div>
                                        </td>
                                        <td width="20px">:</td>
                                        <td class="">Rp. {{ number_format($cek->tunj_transport) ?? '-' }}</td>
                                        @endif
                                    </tr>
                                    <tr class="">
                                        @if($cek->unpaid_leave > 0)
                                        <td class="">Deduction Unpaid Leave</td>
                                        <td width="20px">:</td>
                                        <td class="">Rp. {{ number_format($cek->unpaid_leave) }}</td>
                                        @endif
                                    </tr>
                                    <tr class="">
                                        @if($cek->deduction > 0)
                                        <td class="">Deduction</td>
                                        <td width="20px">:</td>
                                        <td class="">Rp. {{ number_format($cek->deduction) }}</td>
                                        @endif
                                    </tr>
                                    <tr class="">
                                        @if($cek->deduction_pph21 > 0)
                                        <td class="">Deduction PPH 21</td>
                                        <td width="20px">:</td>
                                        <td class="">Rp. {{ number_format($cek->deduction_pph21) }}</td>
                                        @endif
                                    </tr>
                                    <tr class="">
                                        <td class="">Durasi SP</td>
                                        <td width="20px">:</td>
                                        <td class="">{{ $durasi_sp ?? "-"}}</td>
                                    </tr>

                                    <tr class="">
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="text-end text-uppercase small fw-700 text-muted">Morosi, 31 {{ $nm_bln }} {{ $thn }}</div>
                                        </td>
                                    </tr>

                                    <tr class="">
                                        <td>
                                            <div class="text-end text-uppercase small fw-700 text-muted">Di transfer ke</div>
                                        </td>
                                        <td></td>
                                        <td>
                                            <div class="text-center text-uppercase small fw-700 text-muted">Dibuat oleh,</div>
                                        </td>
                                    </tr>

                                    <tr class="">
                                        <td>
                                            <div class="text-end text-uppercase small fw-700 text-muted">{{ $cek->bank_number }}</div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr class="">
                                        <td>
                                            <div class="text-end text-uppercase small fw-700 text-muted">{{ $cek->bank_name }}</div>
                                        </td>
                                        <td></td>
                                        <td>
                                            <div class="text-center mt-4 text-uppercase small fw-700 text-muted">Payroll</div>
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