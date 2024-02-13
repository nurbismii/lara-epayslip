@extends('layouts.app')

@push('css')
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="{{ asset('assets/css/style-custom.css') }}" rel="stylesheet" type="text/css" />
@endpush

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
                            <li class="breadcrumb-item active">Gaji Karyawan</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Gaji Karyawan</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-example-wrap mg-t-30">
                            <div class="cmp-tb-hd cmp-int-hd">
                                <h5>Cari Data Gaji</h5>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Pilih Periode</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="month" name="periode" class="form-control input-sm filter" id="periode" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int mg-t-15">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                        <a href="/salary" class="btn btn-success notika-btn-success">Bersihkan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="table-list-salary" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th width="50px">Nik</th>
                                    <th width="50px">Periode</th>
                                    <th width="80px">Gaji Pokok</th>
                                    <th width="100px">Tunj Uang Makan</th>
                                    <th width="80px">Tunj Pegawai</th>
                                    <th width="100px">Tunj Masa Kerja</th>
                                    <th width="80px">Total</th>
                                    <th width="80px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody> </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
@endpush

@if(Auth::user()->level == "Administrator")
@include('salary.form')
@endif
@endsection