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
                            <li class="breadcrumb-item active">Data Pengumuman</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Data Pengumuman</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <!-- end row-->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4> Data <span class="table-project-n"> Pengumuman</span>
                            @if(Auth::user()->level == "Administrator")
                             <a onclick="add_pengumuman()" class="btn btn-success waves-effect waves-light float-right" style="margin-top: -6px;"><i class="mdi mdi-plus-circle mr-2"></i><b> Pengumuman </b></a>
                            @endif
                            </h4></br>
                        <table id="pengumuman-table" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Description</th>
                                    <th>Gambar</th>
                                    <th>Caption </th>
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
@include('pengumuman.form')
@endif
@endsection

