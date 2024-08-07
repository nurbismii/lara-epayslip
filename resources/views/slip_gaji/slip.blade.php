@extends('layouts.app')
@section('content')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pay SLip</a></li>
                            <li class="breadcrumb-item active">Rincian Gaji</li>
                        </ol>
                    </div>
                    <h5 class="page-title">Slip Gaji</h5>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <!-- Logo & title -->
                    <div class="clearfix">
                        <div class="float-left">
                            <div class="auth-logo">
                                <table>
                                    <tr>
                                        <td>
                                            <h5>NAMA</h5>
                                        </td>
                                        <td>
                                            <h5>:</h5>
                                        </td>
                                        <td>
                                            <h5>{{ $cek->data_karyawan->nama }}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>NIK</h5>
                                        </td>
                                        <td>
                                            <h5>:</h5>
                                        </td>
                                        <td>
                                            <h5>{{ $cek->data_karyawan->nik }}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>DEPARTEMEN</h5>
                                        </td>
                                        <td>
                                            <h5>:</h5>
                                        </td>
                                        <td>
                                            <h5>{{ $cek->departemen }}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>DIVISI</h5>
                                        </td>
                                        <td>
                                            <h5>:</h5>
                                        </td>
                                        <td>
                                            <h5>{{ $cek->divisi }}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>POSISI</h5>
                                        </td>
                                        <td>
                                            <h5>:</h5>
                                        </td>
                                        <td>
                                            <h5>{{ $cek->posisi }}</h5>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="float-right">
                            <h5 class="m-0 d-print-none">PRIBADI DAN RAHASIA</h5>
                            </br> &nbsp &nbsp &nbsp &nbsp
                            <span class="logo-lg">
                                @if($cek->data_karyawan->nm_perusahaan == "VDNI")
                                <img src="{{ asset('assets/images/logo-vdni.png') }}" alt="" height="40">
                                @elseif($cek->data_karyawan->nm_perusahaan == "VDNIP")
                                <img src="{{ asset('assets/images/vdnip-logo.png') }}" alt="" height="35">
                                @else
                                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="22">
                                @endif
                            </span>
                            </br>
                            </br>
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
                            @if($cek->data_karyawan->nm_perusahaan == "VDNI")
                            <h5 class="m-0 d-print-none">SLIP GAJI {{ $nm_bln }} {{ $thn }} </h5>
                            @if($cek->mulai_periode)
                            <h5 class="m-0 d-print-none">{{ getTanggalIndo($cek->mulai_periode) }} - {{ getTanggalIndo($cek->akhir_periode)  }}</h5>
                            @else
                            <h5 class="m-0 d-print-none">16 {{ $nm_bln }} {{ $thn }} - 15 {{ $nm_bln }} {{ $thn }}</h5>
                            @endif

                            @elseif($cek->data_karyawan->nm_perusahaan == "VDNIP")
                            <h5 class="m-0 d-print-none">SLIP GAJI {{ $nm_bln }} {{ $thn }} </h5>
                            @if($cek->mulai_periode)
                            <h5 class="m-0 d-print-none">{{ getTanggalIndo($cek->mulai_periode) }} - {{ getTanggalIndo($cek->akhir_periode)  }}</h5>
                            @else
                            <h5 class="m-0 d-print-none">16 {{ $nm_bln }} {{ $thn }} - 15 {{ $nm_bln }} {{ $thn }}</h5>
                            @endif
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mt-3">
                                <table>
                                    <tr>
                                        <td>JUMLAH HARI KERJA</td>
                                        <td>:</td>
                                        <td> {{ $cek->jml_hari_kerja }} HARI</td>
                                    <tr>
                                    <tr>
                                        <td>STATUS GAJI</td>
                                        <td>:</td>
                                        <td> {{ $cek->status_gaji }}</td>
                                    <tr>
                                </table>
                                <h5>RINCIAN GAJI :</h5>
                                <table>
                                    <tr>
                                        <td>GAJI POKOK</td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($cek->gaji_pokok) }} </td>
                                    </tr>
                                    @if($cek->tunj_um)
                                    <tr>
                                        <td>TUNJANGAN UANG MAKAN</td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($cek->tunj_um) }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->tunj_pengawas)
                                    <tr>
                                        <td>TUNJANGAN PENGAWAS</td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($cek->tunj_pengawas) }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->tunj_koefisien)
                                    <tr>
                                        <td>TUNJANGAN KOEFISIEN JABATAN </td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($cek->tunj_koefisien) }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->tunj_mk)
                                    <tr>
                                        <td>TUNJANGAN MASA KERJA</td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($cek->tunj_mk) }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->tunj_transport)
                                    <tr>
                                        <td>TUNJANGAN TRANSPORT & PULSA</td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($cek->tunj_transport) }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->tunj_lap)
                                    <tr>
                                        <td>TUNJANGAN KINERJA DAN LAPANGAN</td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($cek->tunj_lap) }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->ot)
                                    <tr>
                                        <td>OVERTIME</td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($cek->ot) }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->hm)
                                    <tr>
                                        <td>HOUR MACHINE</td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($cek->hm) }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->insentif)
                                    <tr>
                                        <td>INSENTIF</td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($cek->insentif) }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->rapel)
                                    <tr>
                                        <td>RAPEL</td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($cek->rapel) }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->bonus)
                                    <tr>
                                        <td>BONUS</td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($cek->bonus) }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->thr)
                                    <tr>
                                        <td>TUNJANGAN HARI RAYA</td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($cek->thr) }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>

                        </div><!-- end col -->
                        <div class="col-md-6">
                            <div class="mt-3 float-right">
                                <table>
                                    <tr>
                                        <td>JUMLAH HOUR MACHINE</td>
                                        <td>:</td>
                                        <td>{{ $cek->jml_hour_machine }} JAM</td>
                                    <tr>
                                </table>
                                <h5>POTONGAN :</h5>
                                <table>
                                    @if($cek->jht)
                                    <tr>
                                        <td>BPJS TK JHT</td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($cek->jht) }} </td>
                                    </tr>
                                    @endif
                                    @if($cek->jp)
                                    <tr>
                                        <td>BPJS TK JP</td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($cek->jp) }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->pot_bpjskes)
                                    <tr>
                                        <td>BPJS KESEHATAN</td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($cek->pot_bpjskes) }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->unpaid_leave)
                                    <tr>
                                        <td>DEDUCTION UNPAID LEAVE </td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($cek->unpaid_leave) }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->deduction)
                                    <tr>
                                        <td>DEDUCTION </td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($cek->deduction) }}</td>
                                    </tr>
                                    @endif
                                    @if($cek->deduction_pph21)
                                    <tr>
                                        <td>DEDUCTION PPH 21</td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($cek->deduction_pph21) }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        @if($cek->durasi_sp <= "2015-01-01" ) <?php $durasi_sp = ""; ?> @else <?php $durasi_sp = $cek->durasi_sp; ?> @endif <td>DURASI SURAT PERINGATAN</td>
                                            <td>:</td>
                                            <td>{{ $durasi_sp ?? '-'}}</td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>TOTAL DITERIMA</td>
                                        <td>:</td>
                                        <td><b>Rp {{ number_format($cek->tot_diterima) }} </b></td>
                                    <tr>
                                    <tr>
                                        <td><br></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        @if($cek->tanggal_gajian == NULL)
                                        <td>
                                            <div class="text-uppercase small fw-700 text-muted">Morosi, 31 {{ $nm_bln }} {{ $thn }}</div>
                                        </td>
                                        @else
                                        <td>
                                            <div class="text-uppercase small fw-700 text-muted">Morosi, {{ getTanggalIndo($cek->tanggal_gajian) }}</div>
                                        </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>DI TRANSFER KE</td>
                                        <td></td>
                                        <td>DI BUAT OLEH,</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $cek->bank_number }}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>{{ $cek->bank_name }}</td>
                                        <td></td>
                                        <td>PAYROLL</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $cek->data_karyawan->nama }}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>

                        </div><!-- end col -->
                    </div>
                    <!-- end row -->

                    @if(Auth::user()->level == "Pengguna")
                    <div class="mt-4 mb-1">
                        <form action="{{ route('cetak.slip_gaji', $cek->periode) }}" method="GET" id="downloadForm">
                            <div class="text-right d-print-none">
                                <button id="downloadButton" class="btn btn-primary waves-effect waves-light" type="button">
                                    <i class="mdi mdi-printer mr-1"></i> Download
                                </button>
                            </div>
                        </form>
                    </div>
                    @elseif(Auth::user()->level == "Administrator")
                    <div class="mt-4 mb-1">
                        <form class="from-prevent-multiple-submits" action="{{ route('salary.cetak_pdf') }}" method="POST">
                            @csrf
                            <input type="hidden" name="month" value="{{ $cek->periode }}">
                            <input type="hidden" name="karyawan_id" value="{{ $cek->data_karyawan_id }}">
                            <div class="text-right d-print-none">
                                <button type="submit" class="btn btn-primary waves-effect waves-light from-prevent-multiple-submits"><i class="mdi mdi-printer mr-1"></i> Download</button>
                            </div>
                        </form>
                    </div>
                    @endif
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- container -->
</div> <!-- content -->

<!-- Vendor js -->
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/js/app.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#downloadButton').on('click', function() {
            var button = $(this);
            button.text('File sedang didownload...').prop('disabled', true);
            $('#downloadForm').submit();

            // Re-enable the button after 5 seconds
            setTimeout(function() {
                button.text('Download').prop('disabled', false);
            }, 10000);
        });
    });
</script>

@endsection