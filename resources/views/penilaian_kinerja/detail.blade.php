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
                            <li class="breadcrumb-item active">Kinerja Karyawan dan Pencapaian Kerja</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Kinerja Karyawan dan Pencapaian Kerja</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <center>
                            <h5>HASIL KINERJA DAN PENCAPAIAN KERJA</h5>
                        </center>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <tbody>
                                    <tr>
                                        <td>NAMA</td>
                                        <td>{{ $data->data_karyawan->nama }}</td>
                                        <td>Departemen</td>
                                        <td>@if($div != null) {{ $div->departemen }} @endif</td>
                                        <td rowspan="3">Email</td>
                                        <td rowspan="3">{{ $data->user->email ?? 'Belum terdaftar sebagai pengguna' }}</td>
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
                                        <td>POSISI</td>
                                        <td>@if($div != null) {{ $div->posisi }} @endif</td>

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
                        <h5> I. EVALUASI PENCAPAIAN KINERJA (A)</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <td colspan="2">ASPEK PENILAIAN</td>
                                        <td rowspan="2">PENCAPAIAN KINERJA</td>
                                        <td rowspan="2">CENTANG</td>
                                        <td rowspan="2">NILAI</td>
                                    </tr>
                                    <tr>
                                        <td>JENIS KINERJA</td>
                                        <td>RINCIAN</td>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($penilaian as $kategori => $items)
                                    @php
                                    $rowKategori = collect($items)->sum(fn($i) => count($i['rows']));
                                    $firstKategori = true;
                                    @endphp

                                    @foreach($items as $item)
                                    @php
                                    $field = $item['field'];
                                    $nilai = $data->$field;
                                    $rowItem = count($item['rows']);
                                    $firstItem = true;
                                    @endphp

                                    @foreach($item['rows'] as $row)
                                    <tr>
                                        @if($firstKategori)
                                        <td rowspan="{{ $rowKategori }}"><b>{{ $kategori }}</b></td>
                                        @php $firstKategori = false; @endphp
                                        @endif

                                        @if($firstItem)
                                        <td rowspan="{{ $rowItem }}">{{ $item['title'] }}</td>
                                        @endif

                                        <td>{{ $row['text'] }}</td>
                                        <td class="text-center">
                                            @if($nilai == $row['nilai']) ✔ @endif
                                        </td>

                                        @if($firstItem)
                                        <td rowspan="{{ $rowItem }}">{{ $nilai }}</td>
                                        @php $firstItem = false; @endphp
                                        @endif
                                    </tr>
                                    @endforeach
                                    @endforeach
                                    @endforeach

                                    <tr>
                                        <td colspan="4"><b>TOTAL PEROLEHAN EVALUASI (A)</b></td>
                                        <td><b>{{ $data->total_nilai_kinerja }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <br>
                        <h5>II. EVALUASI PENCAPAIAN KERJA</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <td>PENCAPAIAN KERJA</td>
                                        <td>KOLOM CENTANG</td>
                                        <td>KOLOM NILAI(DIISI OLEH HRD)</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pencapaianKerja as $item)
                                    <tr>
                                        <td>{{ $item['label'] }}</td>
                                        <td class="text-center">
                                            @if($item['value']) ✔ @endif
                                        </td>
                                        <td>{{ $item['value'] }}</td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td colspan="2"><b>TOTAL PEROLEHAN EVALUASI PENCAPAIAN KERJA (B)</b></td>
                                        <td><b>{{ $data->total_nilai_pencapaian }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div> <!-- end row-->
    </div> <!-- container -->
</div>
@if(Auth::user()->level == "Administrator")
@include('salary.form')
@endif
@endsection