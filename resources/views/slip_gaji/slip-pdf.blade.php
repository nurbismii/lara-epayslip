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

        hr.new4 {
            border: 0.5px #000;
        }
    </style>
</head>

<body class="nav-fixed">
    <div id="layoutSidenav">
        <main>
            <div class="container-xl px-1">
                <div class="card-body">
                    <div class="text-center">
                        <h4 class="fw-bold">PT VDNI</h4>
                        @if($cek->data_karyawan->nm_perusahaan == "VDNI")
                        <img src="{{ public_path('assets/images/logo-vdni.png') }}" style="height: 40px;" alt=""><br>
                        @endif
                        @if($cek->data_karyawan->nm_perusahaan == "VDNIP")
                        <img src="{{ public_path('assets/images/vdnip-logo.png') }}" style="height: 30px;" alt=""><br>
                        @endif
                        <span class="fw-normal">SLIP GAJI </span> <br>
                        @if($cek->mulai_periode)
                        <span class="fw-normal">{{ getTanggalIndo($cek->mulai_periode) }} - {{ getTanggalIndo($cek->akhir_periode)  }}</span>
                        @else
                        <span class="fw-normal">16 {{ $nm_bln }} {{ $thn }} - 15 {{ $nm_bln }} {{ $thn }}</span>
                        @endif
                    </div>
                </div>
                <hr class="new4">
                <div class="card-body p-md-5">
                    <!-- Invoice table-->
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td width="100px" scope="row">Nama</td>
                                    <td width="30px">:</td>
                                    <td width="212px">{{ $cek->data_karyawan->nama }}</td>
                                    <td class="">Jumlah hari kerja</td>
                                    <td>:</td>
                                    <td class="">{{ $cek->jml_hari_kerja }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">NIK</td>
                                    <td width="20px">:</td>
                                    <td>{{ $cek->data_karyawan->nik }}</td>
                                    <td class="">Status gaji</td>
                                    <td width="20px">:</td>
                                    <td class="">{{ $cek->status_gaji }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Departemen</td>
                                    <td width="20px">:</td>
                                    <td>{{ $cek->departemen }}</td>
                                    <td class="">Divisi</td>
                                    <td width="20px">:</td>
                                    <td class="">{{ $cek->posisi }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Posisi</td>
                                    <td width="20px">:</td>
                                    <td>{{ $cek->divisi }}</td>
                                    <td class="">Jumlah hour machine</td>
                                    <td width="20px">:</td>
                                    <td class="">{{ $cek->jml_hour_machine ?? '-' }} {{ $cek->jml_hour_machine != '' ? 'Jam' : ''}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row-bet">
                        <div class="column-bet">
                            <table class="table mb-0">
                                <thead class="border-bottom">
                                    <tr class="small text-uppercase text-muted">
                                        <th width="100px" class="text-start" scope="col">Rincian</th>
                                        <th></th>
                                        <th width="150px" class="text-start" scope="col">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($cek->gaji_pokok > 0)
                                    <tr class="">
                                        <td>
                                            <div class="">Gaji pokok</div>
                                        </td>
                                        <td width="20px">:</td>
                                        <td class="">Rp.{{ number_format($cek->gaji_pokok) }}</td>
                                    </tr>
                                    @endif
                                    <!-- Invoice item 2-->
                                    @if($cek->tunj_um > 0)
                                    <tr class="">
                                        <td>
                                            <div class="">Tunj. Uang Makan</div>
                                        </td>
                                        <td width="20px">:</td>
                                        <td class="">Rp. {{ number_format($cek->tunj_um) }}</td>
                                    </tr>
                                    @endif
                                    <!-- Invoice item 3-->
                                    @if($cek->tunj_pengawas > 0)
                                    <tr class="">
                                        <td>
                                            <div class="">Tunj. Pengawas</div>
                                        </td>
                                        <td width="20px">:</td>
                                        <td class="">Rp. {{ number_format($cek->tunj_pengawas) }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->tunj_koefisien > 0)
                                    <tr class="">
                                        <td>
                                            <div class="">Tunj. Koefisien</div>
                                        </td>
                                        <td width="20px">:</td>
                                        <td class="">Rp. {{ number_format($cek->tunj_koefisien) }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->tunj_mk > 0)
                                    <tr class="">
                                        <td>
                                            <div class="">Tunj. Masa Kerja</div>
                                        </td>
                                        <td width="20px">:</td>
                                        <td class="">Rp. {{ number_format($cek->tunj_mk) }}</td>
                                    </tr>
                                    @endif
                                    <!-- Invoice item 4-->
                                    @if($cek->tunj_transport > 0)
                                    <tr class="">
                                        <td>
                                            <div class="">Tunj. Transport</div>
                                        </td>
                                        <td width="20px">:</td>
                                        <td class="">Rp. {{ number_format($cek->tunj_transport) ?? '-' }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->tunj_lap)
                                    <tr>
                                        <td>Tunj. Lapangan</td>
                                        <td>:</td>
                                        <td>Rp. {{ number_format($cek->tunj_lap) }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->ot > 0)
                                    <tr class="">
                                        <td>
                                            <div class="">Lembur</div>
                                        </td>
                                        <td width="20px">:</td>
                                        <td class="">Rp. {{ number_format($cek->ot) }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->hm > 0)
                                    <tr class="">
                                        <td>
                                            <div class="">Hour machine</div>
                                        </td>
                                        <td width="20px">:</td>
                                        <td class="">{{ $cek->hm ?? '-' }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->insentif > 0)
                                    <tr class="">
                                        <td>
                                            <div class="">Insentif</div>
                                        </td>
                                        <td width="20px">:</td>
                                        <td class="">{{ $cek->insentif ?? '-' }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->insentif > 0)
                                    <tr class="">
                                        <td>
                                            <div class="">Rapel</div>
                                        </td>
                                        <td width="20px">:</td>
                                        <td class="">{{ $cek->rapel ?? '-' }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->insentif > 0)
                                    <tr class="">
                                        <td>
                                            <div class="">Bonus</div>
                                        </td>
                                        <td width="20px">:</td>
                                        <td class="">{{ $cek->bonus ?? '-' }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->thr > 0)
                                    <tr class="">
                                        <td>
                                            <div class="">Tunj. hari raya</div>
                                        </td>
                                        <td width="20px">:</td>
                                        <td class="">{{ $cek->thr ?? '-' }}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="column-bet">
                            <table class="table mb-0">
                                <thead class="border-bottom">
                                    <tr class="small text-uppercase text-muted">
                                        <th width="100px" class="text-start" scope="col">Potongan</th>
                                        <th></th>
                                        <th width="140px" class="text-start" scope="col">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($cek->jht > 0)
                                    <tr class="">
                                        <td class="">BPJS TK JHT</td>
                                        <td width="20px">:</td>
                                        <td class="">Rp.{{ number_format($cek->jht) }}</td>
                                    </tr>
                                    @endif
                                    <!-- Invoice item 2-->
                                    @if($cek->jp > 0)
                                    <tr class="">
                                        <td class="">BPJS TK JP</td>
                                        <td width="20px">:</td>
                                        <td class="">Rp. {{ number_format($cek->jp) }}</td>
                                    </tr>
                                    @endif
                                    <!-- Invoice item 3-->
                                    @if($cek->pot_bpjskes > 0)
                                    <tr class="">
                                        <td class="">BPSJ Kesehatan</td>
                                        <td width="20px">:</td>
                                        <td class="">Rp. {{ number_format($cek->pot_bpjskes) }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->unpaid_leave > 0)
                                    <tr class="">
                                        <td class="">Deduction Unpaid Leave</td>
                                        <td width="20px">:</td>
                                        <td class="">Rp. {{ number_format($cek->unpaid_leave) }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->deduction > 0)
                                    <tr class="">
                                        <td class="">Deduction</td>
                                        <td width="20px">:</td>
                                        <td class="">Rp. {{ number_format($cek->deduction) }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->deduction_pph21 > 0)
                                    <tr class="">
                                        <td class="">Deduction PPH 21</td>
                                        <td width="20px">:</td>
                                        <td class="">Rp. {{ number_format($cek->deduction_pph21) }}</td>
                                    </tr>
                                    @endif
                                    <tr class="">
                                        <td class="">Durasi SP</td>
                                        <td width="20px">:</td>
                                        <td class="">{{ $durasi_sp ?? "-"}}</td>
                                    </tr>
                                    <tr>
                                        <td class="pb-0">
                                            <div class="text-uppercase small fw-200">Total Penghasilan</div>
                                        </td>
                                        <td>:</td>
                                        <td class="pb-0">
                                            <div class="h6 mb-0 fw-700">Rp. {{ number_format($cek->tot_diterima) }} </div>
                                        </td>
                                    </tr>

                                    <tr class="">
                                        <td></td>
                                        <td></td>
                                        @if($cek->tanggal_gajian == '')
                                        <td>
                                            <div class="text-uppercase small fw-700 text-muted">Morosi, 31 {{ $nm_bln }} {{ $thn }}</div>
                                        </td>
                                        @else
                                        <td>
                                            <div class="text-uppercase small fw-700 text-muted">Morosi, {{ getTanggalIndo($cek->tanggal_gajian) }}</div>
                                        </td>
                                        @endif
                                    </tr>

                                    <tr class="">
                                        <td>
                                            <div class="text-uppercase small fw-700 text-muted">Di transfer ke</div>
                                        </td>
                                        <td></td>
                                        <td>
                                            <div class="text-uppercase small fw-700 text-muted">Dibuat oleh,</div>
                                        </td>
                                    </tr>

                                    <tr class="">
                                        <td>
                                            <div class="text-uppercase small fw-700 text-muted">{{ $cek->bank_number }}</div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr class="">
                                        <td>
                                            <div class="text-uppercase small fw-700 text-muted">{{ $cek->bank_name }}</div>
                                        </td>
                                        <td></td>
                                        <td>
                                            <div class="mt-4 text-uppercase small fw-700 text-muted">Payroll</div>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td>
                                            <div class="text-uppercase small fw-700 text-muted">{{ $cek->data_karyawan->nama }}</div>
                                        </td>
                                        <td></td>
                                        <td></td>
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