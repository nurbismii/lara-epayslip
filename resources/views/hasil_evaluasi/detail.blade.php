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
                       <center><h5>HASIL EVALUASI</h5></center>
                       <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <tbody>
                                <tr>
                                    <td>NAMA</td>
                                    <td>{{ $data->data_karyawan->nama }}</td>
                                    <td>Departemen</td>
                                    <td>@if($div != null) {{ $div->departemen }} @endif</td>
                                    <td rowspan="2">Email</td>
                                    <td rowspan="2">{{ $data->user->email }}</td>
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
                                       <td>{{ $data->total_nilai_kinerja  }}</td>
                                       <td>45%</td>
                                       <td>{{ number_format($data->total_nilai_kinerja/413.5*910.35,2,'.','') }}</td>
                                   </tr>
                                   <tr>
                                        <td>2</td>
                                        <td>EVALUASI PENCAPAIAN KERJA(B)</td>
                                        <td>{{ $data->total_nilai_pencapaian }}</td>
                                        <td>20%</td>
                                        <td>{{ number_format($data->total_nilai_pencapaian/20*404.6,2,'.','') }}</td>
                                   </tr>
                                   @foreach ($data->data_karyawan->evaluasi_ketenagakerjaan as $evaluasi)
                                   <tr>
                                        <td>3</td>
                                        <td>EVALUASI PATUH KETENAGAKERJAAN(C)</td>
                                        <td>{{ $evaluasi->total_nilai }}</td>
                                        <td>35%</td>
                                        <td>{{ number_format($evaluasi->total_nilai/950*708.50,2,'.','') }}</td>
                                  </tr>
                                  <tr>
                                      <td colspan="4"><b>TOTAL NILAI KESELURUHAN</b></td>
                                      <td><b>{{ number_format(($data->total_nilai_kinerja/413.5*910.35) + ($data->total_nilai_pencapaian/20*404.6) + ($evaluasi->total_nilai/950*708.05),2,'.','')  }}</b></td>
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
                                        <?php
                                            $hasil = ($data->total_nilai_kinerja/413.5*910.35) + ($data->total_nilai_pencapaian/20*404.6) + ($evaluasi->total_nilai/950*708.50);
                                        ?>
                                        <td>{{ ($data->total_nilai_kinerja/413.5*910.35) + ($data->total_nilai_pencapaian/20*404.6) + ($evaluasi->total_nilai/950*708.50)  }}</td>
                                        <td>
                                            @if(($div->data_karyawan->nm_perusahaan == "VDNI") && ($div->departemen == "SMELTER 炼铁厂") && ($div->divisi == "PRODUKSI SMELTER 冶炼厂生产"))
                                                @if(($hasil >= 1861.16) && ($hasil <= 2023))
                                                   Sangat Baik
                                                @elseif(($hasil >= 1679.09) && ($hasil <= 1861.16))
                                                    Baik
                                                @elseif(($hasil >= 1213.08) && ($hasil <= 1679.08))
                                                    Cukup
                                                @elseif(($hasil >= 0) && ($hasil <= 1213.7))
                                                    Kurang
                                                @else
                                                    Undifinied
                                                @endif
                                            @elseif(($div->data_karyawan->nm_perusahaan == "VDNI") && ($div->departemen == "SMELTER 炼铁厂"))
                                                @if(($hasil >= 1921.85) && ($hasil <= 2023))
                                                    Sangat Baik
                                                @elseif(($hasil >= 1679.09) && ($hasil <= 1921.84))
                                                    Baik
                                                @elseif(($hasil >= 1213.08) && ($hasil <= 1679.08))
                                                    Cukup
                                                @elseif(($hasil >= 0) && ($hasil <= 1213.7))
                                                    Kurang
                                                @else
                                                    Undifinied
                                                @endif
                                            @elseif(($div->data_karyawan->nm_perusahaan == "VDNI") && ($div->divisi == "LOGISTIK 物流部"))
                                                @if(($hasil >= 1861.16) && ($hasil <= 2023))
                                                    Sangat Baik
                                                @elseif(($hasil >= 1679.09) && ($hasil <= 1861.16))
                                                    Baik
                                                @elseif(($hasil >= 1213.08) && ($hasil <= 1679.08))
                                                    Cukup
                                                @elseif(($hasil >= 0) && ($hasil <= 1213.7))
                                                    Kurang
                                                @else
                                                    Undifinied
                                                @endif
                                            @elseif(($div->data_karyawan->nm_perusahaan == "VDNIP") && ($div->departemen == "GENERAL AFFAIR 综合部"))
                                                @if(($hasil >= 1998.724) && ($hasil <= 2023))
                                                    Sangat Baik
                                                @elseif(($hasil >= 1719.55) && ($hasil <= 1998.723))
                                                    Baik
                                                @elseif(($hasil >= 1416.01) && ($hasil <= 1719.54))
                                                    Cukup
                                                @elseif(($hasil >= 0) && ($hasil <= 1416.00))
                                                    Kurang
                                                @else
                                                    Undifinied
                                                @endif
                                            @elseif($div->data_karyawan->nm_perusahaan == "VDNIP")
                                                @if(($hasil >= 1921.85) && ($hasil <= 2023))
                                                    Sangat Baik
                                                @elseif(($hasil >= 1719.55) && ($hasil <= 1921.84))
                                                    Baik
                                                @elseif(($hasil >= 1416.01) && ($hasil <= 1719.54))
                                                    Cukup
                                                @elseif(($hasil >= 0) && ($hasil <= 1416.00))
                                                    Kurang
                                                @else
                                                    Undifinied
                                                @endif
                                            @elseif(($div->data_karyawan->nm_perusahaan == "VDNI") || ($div->data_karyawan->nm_perusahaan == "FHNI"))
                                                @if(($hasil >= 1901.62) && ($hasil <= 2023))
                                                    Sangat Baik
                                                @elseif(($hasil >= 1679.09) && ($hasil <= 1901.61))
                                                    Baik
                                                @elseif(($hasil >= 1213.08) && ($hasil <=1679.08))
                                                    Cukup
                                                @elseif(($hasil >= 0) && ($hasil <= 1213.07))
                                                    Kurang
                                                @else
                                                    Undifinied
                                                @endif
                                            @else
                                                Undifinied 
                                            @endif
                                        </td>
                                    </tr>
                               </tbody>
                            </table>
                        </div> <!-- end .table-responsive-->
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->

</div>
@if(Auth::user()->level == "Administrator")
@include('salary.form')
@endif
@endsection

