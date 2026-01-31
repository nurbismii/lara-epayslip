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
                        <table id="state-saving-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Nik</th>
                                    <th>Pencapaian Kinerja (A)</th>
                                    <th>Pencapaian Kerja (B)</th>
                                    <th>Patuh Ketenagakerjaan (C)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td>
                                        @if($d->data_karyawan)
                                        <a href="{{ route('hasil-evaluasi.show', $d->id) }}" target="_blank">
                                            {{ $d->data_karyawan->nik }}
                                        </a>
                                        @else
                                        <span class="text-danger">Data karyawan tidak tersedia</span>
                                        @endif
                                    </td>

                                    <td>{{ $d->total_nilai_kinerja ?? '-' }}</td>
                                    <td>{{ $d->total_nilai_pencapaian ?? '-' }}</td>

                                    <td>
                                        @php
                                        $evaluasi = optional($d->data_karyawan)->evaluasi_ketenagakerjaan->first();
                                        @endphp

                                        {{ $evaluasi->total_nilai ?? '-' }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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