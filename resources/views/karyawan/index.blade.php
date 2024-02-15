@extends('layouts.app')

@push('css')
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="{{ asset('assets/css/style-custom.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pay Slip</a></li>
                            <li class="breadcrumb-item active">Data Karyawan</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Data Karyawan</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @if(session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                @if(isset($errors) && $errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    {{ $error }}
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('perubahan') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-example-wrap mg-t-30">
                                <div class="cmp-tb-hd cmp-int-hd">
                                    <h5>Upload baru atau update data</h5>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label class="hrzn-fm">Pilih File (.xls .xlsx)</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="nk-int-st">
                                                    <input type="file" name="file" class="form-control input-sm" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-example-int mg-t-15">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <button class="btn float-right btn-success notika-btn-success">Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('hapus_karyawan') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-example-wrap mg-t-30">
                                <div class="cmp-tb-hd cmp-int-hd">
                                    <h5>Hapus Data Karyawan</h5>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label class="hrzn-fm">Pilih File (.xls .xlsx)</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="nk-int-st">
                                                    <input type="file" name="file" class="form-control input-sm" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-example-int mg-t-15">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <button class="btn float-right btn-danger notika-btn-success">Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(session()->has('failures'))
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4> Data <span class="table-project-n"> Error</span>
                        </h4>
                        </br>
                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Row</th>
                                    <th>Attribute</th>
                                    <th>Errors</th>
                                    <th>Value </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $row = ""; ?>
                                @foreach (session()->get('failures') as $validation)
                                @if($row != $validation->row())
                                <tr>
                                    <td>{{ $validation->row() }}</td>
                                    <td>{{ $validation->attribute() }}</td>
                                    <td>
                                        @foreach ($validation->errors() as $e)
                                        <ul>
                                            <li>{{ $e }}</li>
                                        </ul>
                                        @endforeach
                                    </td>
                                    <td>{{ $validation->values()[$validation->attribute()] }}</td>
                                </tr>
                                @endif
                                <?php $row = $validation->row(); ?>
                                @endforeach
                            </tbody>
                        </table>
                        </br>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        @if(Auth::user()->level == "Administrator")

                        <h4> Data <span class="table-project-n"> Karyawan</span>
                            <a onclick="add_karyawan()" class="btn btn-success waves-effect waves-light float-right" style="margin-top: -6px;"><i class="mdi mdi-plus-circle mr-2"></i><b> Karyawan </b></a>
                        </h4>
                        </br>
                        @endif
                        <table id="table-list-karyawan" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th width="50px">Nik</th>
                                    <th width="95px">No KTP</th>
                                    <th width="120px">Nama</th>
                                    <th width="64px">Perusahaan</th>
                                    <th width="50px">Tgl Lahir</th>
                                    <th width="40px">Vaksin </th>
                                    <th width="50px">Tgl Join</th>
                                    <th width="40px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        </br>
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

@include('karyawan.form')

@endif
@endsection