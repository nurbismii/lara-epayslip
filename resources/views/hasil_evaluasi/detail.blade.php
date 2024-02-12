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
                                        <td>{{ $data->total_nilai_kinerja  }}</td>
                                        <td>45%</td>
                                        <td>{{ number_format($data->total_nilai_kinerja/413.5*910.8,2,'.','') }}</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>EVALUASI PENCAPAIAN KERJA(B)</td>
                                        <td>{{ $data->total_nilai_pencapaian }}</td>
                                        <td>20%</td>
                                        <td>{{ number_format($data->total_nilai_pencapaian/20*404.8,2,'.','') }}</td>
                                    </tr>
                                    @foreach ($data->data_karyawan->evaluasi_ketenagakerjaan as $evaluasi)
                                    <tr>
                                        <td>3</td>
                                        <td>EVALUASI PATUH KETENAGAKERJAAN(C)</td>
                                        <td>{{ $evaluasi->total_nilai }}</td>
                                        <td>35%</td>
                                        <td>{{ number_format($evaluasi->total_nilai/950*708.4,2,'.','') }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><b>TOTAL NILAI KESELURUHAN</b></td>
                                        <td><b>{{ number_format(($data->total_nilai_kinerja/413.5*910.8) + ($data->total_nilai_pencapaian/20*404.8) + ($evaluasi->total_nilai/950*708.4),2,'.','')  }}</b></td>
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
                                        $hasil = ($data->total_nilai_kinerja / 413.5 * 910.8) + ($data->total_nilai_pencapaian / 20 * 404.8) + ($evaluasi->total_nilai / 950 * 708.4);
                                        ?>
                                        <td>{{ ($data->total_nilai_kinerja/413.5*910.8) + ($data->total_nilai_pencapaian/20*404.8) + ($evaluasi->total_nilai/950*708.4)  }}</td>
                                        <td>
                                            @if(($div->data_karyawan->nm_perusahaan == 'VDNIP') && ($div->divisi == 'HUMAS 公共关系-KAPOIALA'))

                                            @if(($hasil >= 1963.28) && ($hasil <= 2024)) 
                                            
                                            Sangat baik 
                                            @elseif(($hasil>= 1922.8) && ($hasil <= 1963.27)) Baik 
                                            @elseif(($hasil>= 1416.8) && ($hasil <= 1922.79)) Cukup 
                                            @else Kurang 
                                            @endif 
                                            
                                            @elseif($div->data_karyawan->nm_perusahaan == 'VDNIP')

                                                       
                                            
                                            
                                            @if(($hasil >= 1922.8) && ($hasil <= 2024)) 
                                            
                                            Sangat baik
                                            @elseif(($hasil>= 1821.6) && ($hasil <= 1922.79)) 
                                            Baik 
                                            @elseif(($hasil>= 1416.8) && ($hasil <= 1821.59)) 
                                            Cukup
                                            @else Kurang 
                                            @endif 
                                            
                                            @elseif($div->data_karyawan->nm_perusahaan == 'VDNI')           
                                            
                                            @if(($div->divisi == 'LOADER SMELTER 冶炼装载机') || ($div->divisi == 'TUNGKU 1- 15 熔炉') || ($div->divisi == 'WELDER SMELTER 钳工') || ($div->divisi == 'CONTROL ROOM SMELTER 铁厂中控') || ($div->divisi == 'GUDANG ORE 原料普工') || ($div->divisi == 'LOGISTIK 物流部') || ($div->divisi == 'EXCAVATOR SMELTER 冶炼挖掘机'))

                                                                    
                                            @if(($hasil >= 1943.04) && ($hasil <= 2024)) 
                                            Sangat baik 
                                            @elseif(($hasil>= 1922.8) && ($hasil <= 1943.03)) 
                                            Baik 
                                            @elseif(($hasil>= 1214.4) && ($hasil <= 1922.79)) 
                                            Cukup 
                                            @else 
                                            Kurang 
                                            @endif 
                                            
                                            @elseif($div->departemen == 'ADMINISTRATION DEPARTMENT')

                                                                                
                                            @if(($hasil >= 1943.04) && ($hasil <= 2024)) 
                                            Sangat baik 
                                            @elseif(($hasil>= 1679.92) && ($hasil <= 1943.03)) Baik 
                                            @elseif(($hasil>= 1214.4) && ($hasil <= 1679.91)) Cukup 
                                            @else Kurang 
                                            @endif
                                            
                                            @elseif($div->divisi == 'TRANSPORTASI JETTY 码头储运部')

                                                                                           
                                            @if(($hasil >= 1902.56) && ($hasil <= 2024)) Sangat baik 
                                            @elseif(($hasil>= 1781.12) && ($hasil <= 1902.55)) Baik 
                                            @elseif(($hasil>= 1214.4) && ($hasil <= 1781.11)) Cukup 
                                            @else Kurang 
                                            @endif 
                                            
                                            @elseif(($div->divisi == 'WAREHOUSE 仓库') || $div->departemen == 'SMELTER 炼铁厂')

                                                                                                        
                                            @if(($hasil >= 1943.04) && ($hasil <= 2024)) Sangat baik 
                                            @elseif(($hasil>= 1679.92) && ($hasil <= 1943.03)) Baik 
                                            @elseif(($hasil>= 1214.4) && ($hasil <= 1679.91)) Cukup 
                                            @else Kurang 
                                            @endif 
                                            
                                            @else 
                                            
                                            @if(($hasil>= 1902.56) && ($hasil <= 2024)) Sangat baik @elseif(($hasil>= 1679.92) && ($hasil <= 1902.55)) Baik @elseif(($hasil>= 1214.4) && ($hasil <= 1679.91)) Cukup @else Kurang @endif @endif @else Undifined @endif </td>
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