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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pay Slip</a></li>
                            <li class="breadcrumb-item active">Hasil Evaluasi</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Hasil Evaluasi</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <center>
                            <h5>HASIL EVALUASI</h5>
                        </center>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <tbody>
                                    <tr>
                                        <td>NAMA</td>
                                        <td>{{ $data->data_karyawan->nama }}</td>
                                        <td>Departemen</td>
                                        <td>@if($div != null) {{ $div->departemen }} @endif</td>
                                        <td rowspan="2">Email</td>
                                        <td rowspan="2">{{ $data->user->email ?? 'Tidak terdaftar sebagai pengguna' }}</td>
                                    </tr>
                                    <tr>
                                        <td>NIK</td>
                                        <td>{{ $data->data_karyawan->nik }}</td>
                                        <td>DIVISI</td>
                                        <td>@if($div != null) {{ $div->divisi }} @endif</td>

                                    </tr>
                                    <tr>
                                        <td>TANGGAL MASUK KERJA</td>
                                        <td>{{ $data->data_karyawan->tgl_join }}</td>
                                        <td colspan="2">POSISI</td>
                                        <td colspan="2">@if($div != null) {{ $div->posisi }} @endif</td>

                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- end .table-responsive-->
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5> HASIL EVALUASI </h5>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <td>NO</td>
                                        <td>POIN PENILAIAN</td>
                                        <td>TOTAL NILAI DIPEROLEH</td>
                                        <td>PRESENTASI KATEGORI PENILAIAN</td>
                                        <td>HASIL NILAI TERKONVERSI</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>EVALUASI PENCAPAIAN KINERJA(A)</td>
                                        @if($data->total_nilai_kinerja/413.5*911.7 > 0)
                                        <td>{{ $data->total_nilai_kinerja  }}</td>
                                        @else
                                        @php
                                        $data->total_nilai_kinerja = 0
                                        @endphp
                                        <td>0</td>
                                        @endif
                                        <td>45%</td>
                                        @if($data->total_nilai_kinerja/413.5*911.7 > 0)
                                        <td>{{ number_format($data->total_nilai_kinerja/413.5*911.7,2,'.','') }}</td>
                                        @else
                                        <td>0</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>EVALUASI PENCAPAIAN KERJA(B)</td>
                                        @if($data->total_nilai_pencapaian > 0)
                                        <td>{{ $data->total_nilai_pencapaian }}</td>
                                        @else
                                        @php
                                        $data->total_nilai_pencapaian = 0
                                        @endphp
                                        <td>0</td>
                                        @endif
                                        <td>20%</td>
                                        @if($data->total_nilai_pencapaian/20*405.2 > 0)
                                        <td>{{ number_format($data->total_nilai_pencapaian/20*405.2,2,'.','') }}</td>
                                        @else
                                        <td>0</td>
                                        @endif
                                    </tr>
                                    @foreach ($data->data_karyawan->evaluasi_ketenagakerjaan as $evaluasi)
                                    <tr>
                                        <td>3</td>
                                        <td>EVALUASI PATUH KETENAGAKERJAAN(C)</td>
                                        @if($evaluasi->total_nilai/950*709.1 > 0)
                                        <td>{{ $evaluasi->total_nilai }}</td>
                                        @else
                                        @php
                                        $evaluasi->total_nilai = 0
                                        @endphp
                                        <td>0</td>
                                        @endif
                                        <td>35%</td>
                                        @if($evaluasi->total_nilai/950*709.1 > 0)
                                        <td>{{ number_format($evaluasi->total_nilai/950*709.1,2,'.','') }}</td>
                                        @else
                                        <td>0</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td colspan="4"><b>TOTAL NILAI KESELURUHAN</b></td>
                                        <td><b>{{ number_format(($data->total_nilai_kinerja/413.5*911.7) + ($data->total_nilai_pencapaian/20*405.2) + ($evaluasi->total_nilai/950*709.1),2,'.','')  }}</b></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end .table-responsive-->
                        <br>
                        <h5>HASIL AKHIR PENILAIAN</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <td>TOTAL NILAI DIPEROLEH</td>
                                        <td>KATEGORI</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @php
                                        $hasil = ($data->total_nilai_kinerja / 413.5 * 911.7) + ($data->total_nilai_pencapaian / 20 * 405.2) + ($evaluasi->total_nilai / 950 * 709.1);
                                        @endphp
                                        <td>{{ number_format($hasil,2,'.','') }}</td>
                                        <td>
                                            {{ getDivisiRating($div->data_karyawan->nm_perusahaan, $div->divisi, $div->departemen ?? null, $hasil) }}
                                        </td>
                                </tbody>
                            </table>
                        </div> <!-- end .table-responsive-->
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
    </div> <!-- container -->
</div>
@if(Auth::user()->level == "Administrator")
@include('salary.form')
@endif
@endsection