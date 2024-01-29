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
                        <form class="form-inline">
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control border" id="dash-daterange">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-blue border-blue text-white">
                                            <i class="mdi mdi-calendar-range"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <a href="javascript: void(0);" class="btn btn-blue btn-sm ml-2">
                                <i class="mdi mdi-autorenew"></i>
                            </a>
                            <a href="javascript: void(0);" class="btn btn-blue btn-sm ml-1">
                                <i class="mdi mdi-filter-variant"></i>
                            </a>
                        </form>
                    </div>
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        @if(Auth::user()->level == "Administrator")
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                <i class="fe-users font-22 avatar-title text-info"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="mt-1"><span data-plugin="counterup">{{ $karyawan }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Total Data Karyawan</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                <i class="fe-user font-22 avatar-title text-primary"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $user }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Pengguna</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
        </div>

        <!-- end row -->
        @endif
        @if(Auth::user()->level == "Pengguna")
        <div class="row">
            @foreach ($pengumuman as $p)
            <div class="col-lg-6 col-xl-3">
                <!-- Simple card -->
                <div class="card">
                    <a href="{{ asset('images/500/'. $p->image .'') }}" target="_blank"><img class="card-img-top img-fluid" src="{{ asset('images/500/'. $p->image .'') }}" alt="Card image cap"></a>
                    <p class="card-text" align="center"><i>{{ $p->caption }}</i></p>
                    <div class="card-body">
                        <h5 class="card-title">{{ $p->judul }}</h5>
                        <p class="card-text">{{ $p->description }}</a>
                    </div>
                </div>
            </div><!-- end col -->

            @endforeach
        @endif



        </div>
        <!-- end row -->

    </div> <!-- container -->

</div> <!-- content -->
@endsection
