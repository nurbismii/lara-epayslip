@extends('layouts.app')

@push('css')
<style>
    @keyframes chartjs-render-animation {
        from {
            opacity: .99
        }

        to {
            opacity: 1
        }
    }

    .chartjs-render-monitor {
        animation: chartjs-render-animation 1ms
    }

    .chartjs-size-monitor,
    .chartjs-size-monitor-expand,
    .chartjs-size-monitor-shrink {
        position: absolute;
        direction: ltr;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        overflow: hidden;
        pointer-events: none;
        visibility: hidden;
        z-index: -1
    }

    .chartjs-size-monitor-expand>div {
        position: absolute;
        width: 1000000px;
        height: 1000000px;
        left: 0;
        top: 0
    }

    .chartjs-size-monitor-shrink>div {
        position: absolute;
        width: 200%;
        height: 200%;
        left: 0;
        top: 0
    }
</style>
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
                                <i class="fe-user-check font-22 avatar-title text-primary"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $user_aktif }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Pengguna aktif</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                <i class="fe-user-x font-22 avatar-title text-warning"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $user_nonaktif }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Pengguna tidak aktif</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                <i class="fe-upload font-22 avatar-title text-success"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $list_queue }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Antrian file</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- end row -->
        @endif
        @if(Auth::user()->level == "Pengguna")
        <div class="row">
            <div class="col-lg-4">
                <div class="card bg-secondary">
                    <div class="card-body text-white">
                        <img src="{{ asset('assets/images/users/user-1.jpg')}}" alt="user-image" class="rounded-circle mb-3" style="height: 7em;">
                        <h5 class="card-title text-white">{{ Auth::user()->name }} | {{ Auth::user()->karyawan->nik }} </h5>
                        <table>
                            <tr>
                                <td>Departemen</td>
                                <td>:</td>
                                <td>{{ Auth::user()->komponenGaji->departemen }}</td>
                            </tr>
                            <tr>
                                <td>Divisi</td>
                                <td>:</td>
                                <td>{{ Auth::user()->komponenGaji->divisi }}</td>
                            </tr>
                            <tr>
                                <td>Posisi</td>
                                <td>:</td>
                                <td>{{ Auth::user()->komponenGaji->posisi }}</td>
                            </tr>
                            <tr>
                                <td>BPJS</td>
                                <td>:</td>
                                <td>{{ Auth::user()->karyawan->bpjs_ket }}</td>
                            </tr>
                            <tr>
                                <td>BPJS TK</td>
                                <td>:</td>
                                <td>{{ Auth::user()->karyawan->bpjs_tk }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        Pengumumam
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($post_pengumuman as $p)
                        <a href="" data-toggle="modal" data-target="#post_pengumuman{{$p->id}}">
                            <li class="list-group-item">{{ $p->judul }}</li>
                        </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

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
    </div> <!-- container -->
</div> <!-- content -->

@foreach ($post_pengumuman as $p)
<div class="modal fade" id="post_pengumuman{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">{{ $p->judul }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <img src="{{ asset('images/' . $p->image)}}" alt="user-image" class="rounded mb-3" style="height: 25em;">
            <div class="modal-body">
                {{ $p->description }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection