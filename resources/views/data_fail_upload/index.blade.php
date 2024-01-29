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
                            <li class="breadcrumb-item active">Data Tertolak</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Data Tertolak</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <table id="example" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th style="width:10%">No</th>
                                    <th>Nik</th>
                                    <th>No KTP</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($data as $d)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $d->nik }}</td>
                                    <td>{{ $d->no_ktp }}</td>
                                </tr>
                                <?php $no++; ?>
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

