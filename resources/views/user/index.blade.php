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
                            <li class="breadcrumb-item active">Data Pengguna</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Data Pengguna</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
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
                        <form action="{{ route('nonaktifkan_pengguna') }}" method="post" enctype="multipart/form-data">
                            @csrf

                                 <div class="form-example-wrap mg-t-30">
                                     <div class="cmp-tb-hd cmp-int-hd">
                                         <h5>Nonaktifkan Data Pengguna</h5>
                                     </div>
                                     <div class="form-example-int form-horizental">
                                         <div class="form-group">
                                             <div class="row">
                                                 <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                     <label class="hrzn-fm">Pilih File (.xls .xlsx)</label>
                                                 </div>
                                                 <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                     <div class="nk-int-st">
                                                         <input type="file" name="file" class="form-control input-sm" required>
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
                                                 <button class="btn btn-danger notika-btn-success">Upload</button>
                                             </div>
                                         </div>
                                     </div>
                                    </div>
                               </form>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
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

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        @endif

        <!-- end row-->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4> Data <span class="table-project-n">Data Pengguna</span>
                            </h4></br>
                        <table id="user-table" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Nik</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Status </th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

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
@include('user.form')
@endif
@endsection

