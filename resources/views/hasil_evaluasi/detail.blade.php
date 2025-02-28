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
                                        @if($data->total_nilai_kinerja/413.5*911.25	> 0)
                                        <td>{{ $data->total_nilai_kinerja  }}</td>
                                        @else
                                        @php
                                        $data->total_nilai_kinerja = 0
                                        @endphp
                                        <td>0</td>
                                        @endif
                                        <td>45%</td>
                                        @if($data->total_nilai_kinerja/413.5*911.25 > 0)
                                        <td>{{ number_format($data->total_nilai_kinerja/413.5*911.25,2,'.','') }}</td>
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
                                        @if($data->total_nilai_pencapaian/20*405 > 0)
                                        <td>{{ number_format($data->total_nilai_pencapaian/20*405,2,'.','') }}</td>
                                        @else
                                        <td>0</td>
                                        @endif
                                    </tr>
                                    @foreach ($data->data_karyawan->evaluasi_ketenagakerjaan as $evaluasi)
                                    <tr>
                                        <td>3</td>
                                        <td>EVALUASI PATUH KETENAGAKERJAAN(C)</td>
                                        @if($evaluasi->total_nilai/950*708.75 > 0)
                                        <td>{{ $evaluasi->total_nilai }}</td>
                                        @else
                                        @php
                                        $evaluasi->total_nilai = 0
                                        @endphp
                                        <td>0</td>
                                        @endif
                                        <td>35%</td>
                                        @if($evaluasi->total_nilai/950*708.75 > 0)
                                        <td>{{ number_format($evaluasi->total_nilai/950*708.75,2,'.','') }}</td>
                                        @else
                                        <td>0</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td colspan="4"><b>TOTAL NILAI KESELURUHAN</b></td>
                                        <td><b>{{ number_format(($data->total_nilai_kinerja/413.5*911.25) + ($data->total_nilai_pencapaian/20*405) + ($evaluasi->total_nilai/950*708.75),2,'.','')  }}</b></td>
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
                                        $hasil = ($data->total_nilai_kinerja / 413.5 * 911.25) + ($data->total_nilai_pencapaian / 20 * 405) + ($evaluasi->total_nilai / 950 * 708.75);
                                        ?>
                                        <td>{{ number_format($hasil,2,'.','') }}</td>
                                        <td>
                                        @if($div->data_karyawan->nm_perusahaan == 'VDNIP')
                                            @switch($div->divisi)
                                                @case('HUMAS 公共关系-BONDOALA')
                                                @case('PEMADAM KEBAKARAN 消防')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1923.75, 2025],
                                                            'Baik' => [1822.5, 1923.74],
                                                            'Cukup' => [1417.5, 1822.4]
                                                        ];
                                                    @endphp
                                                    @break

                                                @case('HUMAS 公共关系-MOROSI')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1964.25, 2025],
                                                            'Baik' => [1883.25, 1964.24],
                                                            'Cukup' => [1518.75, 1883.24]
                                                        ];
                                                    @endphp
                                                    @break

                                                @case('EXTERNAL AFFAIR 外事部')
                                                @case('PTL (PENANGGUNG JAWAB TEKNIK LINGKUNGAN)')
                                                @case('HUMAS 公共关系-KANAL')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1964.25, 2025],
                                                            'Baik' => [1903.5, 1964.24],
                                                            'Cukup' => [1620, 1903.4]
                                                        ];
                                                    @endphp
                                                    @break

                                                @case('HUMAS 公共关系-KAPOIALA')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [2004.75, 2025],
                                                            'Baik' => [1944, 2004.74],
                                                            'Cukup' => [1417.5, 1993]
                                                        ];
                                                    @endphp
                                                    @break

                                                @case('HUMAS 公共关系-TKA')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1964.25, 2025],
                                                            'Baik' => [1741.5, 1964.24],
                                                            'Cukup' => [1417.5, 1741.4]
                                                        ];
                                                    @endphp
                                                    @break

                                                @case('SECURITY 保安')
                                                @case('SECURITY JETTY 码头保安')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1923.75, 2025],
                                                            'Baik' => [1701, 1923.74],
                                                            'Cukup' => [1437.75, 1700]
                                                        ];
                                                    @endphp
                                                    @break

                                                @default
                                                    @php
                                                        $ranges = [];
                                                    @endphp
                                            @endswitch

                                            @if(!empty($ranges))
                                                @php
                                                    $result = 'Kurang';
                                                    foreach ($ranges as $label => $range) {
                                                        if ($hasil >= $range[0] && $hasil <= $range[1]) {
                                                            $result = $label;
                                                            break;
                                                        }
                                                    }
                                                @endphp
                                                    {{ $result }}
                                                @else
                                                    Kurang
                                            @endif
                                        @endif

                                        @if($div->data_karyawan->nm_perusahaan == 'VDNI')

                                            @switch($div->divisi)
                                                
                                                @case('ADMINISTRATION 行政')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1994, 2025],
                                                            'Baik' => [1822.5, 1993],
                                                            'Cukup' => [1417.5, 1822.4]
                                                        ];
                                                    @endphp
                                                @break

                                                @case('FINANCE 财务部')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1822.5, 2025],
                                                            'Baik' => [1741.5, 1822.4],
                                                            'Cukup' => [1235.25, 1741.4]
                                                        ];
                                                    @endphp
                                                @break

                                                @case('KONSTRUKSI 基建')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1964.25, 2025],
                                                            'Baik' => [1842.75, 1964.24],
                                                            'Cukup' => [1417.5, 1842.74]
                                                        ];
                                                    @endphp
                                                @break

                                                @case('ALAT BERAT 车队')
                                                @case('LOGISTIK 物流部')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1782, 2025],
                                                            'Baik' => [1640.25, 1781],
                                                            'Cukup' => [1417.5, 1640.24]
                                                        ];
                                                    @endphp
                                                @break

                                                @case('PMS JETTY 码头')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1944, 2025],
                                                            'Baik' => [1863, 1943],
                                                            'Cukup' => [1539, 1862]
                                                        ];
                                                    @endphp
                                                @break

                                                @case('LABORATORIUM ORE 矿石实验室')
                                                @case('LABORATORIUM SMELTER 铁厂化验室')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1822.5, 2025],
                                                            'Baik' => [1620, 1822.4],
                                                            'Cukup' => [1235.25, 1619]
                                                        ];
                                                    @endphp
                                                @break

                                                @case('TUNGKU 1- 15 熔炉')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1903.5, 2025],
                                                            'Baik' => [1741.5, 1903.4],
                                                            'Cukup' => [1417.5, 1741.4]
                                                        ];
                                                    @endphp
                                                @break

                                                @case('CONTROL ROOM SMELTER 铁厂中控')
                                                @case('OFFICE SMELTER 办公室')
                                                @case('PEMBUANGAN MATERIAL 下料口')
                                                @case('PENERIMAAN MATERIAL 材料验收')
                                                @case('PERALATAN SMELTER 设备科')
                                                @case('PRODUKSI SMELTER 冶炼厂生产')
                                                @case('SAFETY SMELTER 铁厂安环员')
                                                @case('TRAILLER SMELTER 铁厂车队')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1903.5, 2025],
                                                            'Baik' => [1802.25, 1903.4],
                                                            'Cukup' => [1417.5, 1802.24]
                                                        ];
                                                    @endphp
                                                @break

                                                @case('CRANE HOIST 行车')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1964.25, 2025],
                                                            'Baik' => [1863, 1964.24],
                                                            'Cukup' => [1417.5, 1862]
                                                        ];
                                                    @endphp
                                                @break

                                                @case('ELEKTRIK SMELTER 铁厂电工')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1964.25, 2025],
                                                            'Baik' => [1883.25, 1964.24],
                                                            'Cukup' => [1417.5, 1883.24]
                                                        ];
                                                    @endphp
                                                @break

                                                @case('EXCAVATOR SMELTER 冶炼挖掘机')
                                                @case('LOADER SMELTER 冶炼装载机')
                                                @case('LOADER SMELTER 装载机')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1944, 2025],
                                                            'Baik' => [1782, 1943],
                                                            'Cukup' => [1417.5, 1781]
                                                        ];
                                                    @endphp
                                                @break

                                                @case('GUDANG ORE 原料')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1964.25, 2025],
                                                            'Baik' => [1782, 1964.24],
                                                            'Cukup' => [1417.5, 1781]
                                                        ];
                                                    @endphp
                                                @break

                                                @case('KILEN DEBU 回窑电除尘')
                                                @case('PENGURUS LAHAN 征地办')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1903.5, 2025],
                                                            'Baik' => [1863, 1903.4],
                                                            'Cukup' => [1417.5, 1862]
                                                        ];
                                                    @endphp
                                                @break

                                                @case('KILEN 回窑')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1964.25, 2025],
                                                            'Baik' => [1802.25, 1964.24],
                                                            'Cukup' => [1417.5, 1802.24]
                                                        ];
                                                    @endphp
                                                @break

                                                @case('SMELTER (1,2,3) LANTAI 3/4 地板冶炼厂(1,2,3)3/4')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1822.5, 2025],
                                                            'Baik' => [1741.5, 1822.4],
                                                            'Cukup' => [1417.5, 1741.4]
                                                        ];
                                                    @endphp
                                                @break

                                                @case('WELDER SMELTER 钳工')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1980.45, 2025],
                                                            'Baik' => [1944, 1980.44],
                                                            'Cukup' => [1417.5, 1943]
                                                        ];
                                                    @endphp
                                                @break

                                                @case('WAREHOUSE 仓库')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1964.25, 2025],
                                                            'Baik' => [1822.5, 1964.24],
                                                            'Cukup' => [1417.5, 1822.4]
                                                        ];
                                                    @endphp
                                                @break

                                                @case('WORKSHOP  JETTY 修理部')
                                                @case('WORKSHOP 修理部')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1802.25, 2025],
                                                            'Baik' => [1640.25, 1802.24],
                                                            'Cukup' => [1417.5, 1640.24]
                                                        ];
                                                    @endphp
                                                @break

                                                @case('OPERASIONAL GA 综合运营事务')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1923.75, 2025],
                                                            'Baik' => [1640.25, 1923.74],
                                                            'Cukup' => [1417.5, 1640.24]
                                                        ];
                                                    @endphp
                                                @break

                                                @case('KEBERSIHAN 后勤')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1964.25, 2025],
                                                            'Baik' => [1782, 1964.24],
                                                            'Cukup' => [1417.5, 1781]
                                                        ];
                                                    @endphp
                                                @break

                                                @case('KITCHEN 厨房')
                                                @case('ELEKTRIK PERBAIKAN 电气维修')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1923.75, 2025],
                                                            'Baik' => [1782, 1923.74],
                                                            'Cukup' => [1417.5, 1781]
                                                        ];
                                                    @endphp
                                                @break

                                                @case('GENERAL AFFAIR 综合部')
                                                    @php
                                                        $ranges = [
                                                            'Sangat baik' => [1802.25, 2025],
                                                            'Baik' => [1640.25, 1802.24],
                                                            'Cukup' => [1417.5, 1640.24]
                                                        ];
                                                    @endphp
                                                @break
                                                
                                                @default
                                                    @php
                                                        $ranges = [
                                                            'Sangat Baik' => [1903.5, 2025],
                                                            'Baik' => [1741.5, 1903.4],
                                                            'Cukup' => [1235.25, 1741.4],
                                                        ];
                                                    @endphp

                                            @endswitch

                                            @if(!empty($ranges))
                                                @php
                                                    $result = 'Kurang';
                                                    foreach ($ranges as $label => $range) {
                                                        if ($hasil >= $range[0] && $hasil <= $range[1]) {
                                                            $result = $label;
                                                            break;
                                                        }
                                                    }
                                                @endphp
                                                    {{ $result }}
                                                @else
                                                    Kurang
                                            @endif

                                        @endif
                                    </td>
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