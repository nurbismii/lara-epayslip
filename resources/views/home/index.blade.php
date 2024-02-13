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

            <div class="col-md-6 col-xl-8">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="canvas" style="width:100%;max-width:800px" class="chartjs-render-monitor"></canvas>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->

            <div class="col-md-6 col-lg-4 col-xl-4 order-0">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="fw-bold">Selisih total bayar tahun {{ $tahun_lalu }} & {{ $tahun_sekarang }}</h5>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-2">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Januari</h6>
                                        @if(number_format($persentase[0]) > 0)
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi kenaikan </small>
                                        @elseif(number_format($persentase[0]) == 0)
                                        <small class="text-muted">Data belum tersedia...</small>
                                        @else
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi penurunan </small>
                                        @endif
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ number_format($persentase[0], 2) }}%
                                            @if(number_format($persentase[0]) > 0)
                                            <i class="fe-arrow-up font-12 text-success"></i>
                                            @elseif(number_format($persentase[0]) == 0)
                                            <i class="fe-minus font-12 text-black"></i>
                                            @else
                                            <i class="fe-arrow-down font-12 text-danger"></i>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-2 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Februari</h6>
                                        @if(number_format($persentase[1]) > 0)
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi kenaikan </small>
                                        @elseif(number_format($persentase[1]) == 0)
                                        <small class="text-muted">Data belum tersedia...</small>
                                        @else
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi penurunan </small>
                                        @endif
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ number_format($persentase[1], 2) }}%
                                            @if(number_format($persentase[1]) > 0)
                                            <i class="fe-arrow-up font-12 text-success"></i>
                                            @elseif(number_format($persentase[1]) == 0)
                                            <i class="fe-minus font-12 text-black"></i>
                                            @else
                                            <i class="fe-arrow-down font-12 text-danger"></i>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-2 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Maret</h6>
                                        @if(number_format($persentase[2]) > 0)
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi kenaikan </small>
                                        @elseif(number_format($persentase[2]) == 0)
                                        <small class="text-muted">Data belum tersedia...</small>
                                        @else
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi penurunan </small>
                                        @endif
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ number_format($persentase[2], 2) }}%
                                            @if(number_format($persentase[2]) > 0)
                                            <i class="fe-arrow-up font-12 text-success"></i>
                                            @elseif(number_format($persentase[2]) == 0)
                                            <i class="fe-minus font-12 text-black"></i>
                                            @else
                                            <i class="fe-arrow-down font-12 text-danger"></i>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-2 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">April</h6>
                                        @if(number_format($persentase[3]) > 0)
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi kenaikan </small>
                                        @elseif(number_format($persentase[3]) == 0)
                                        <small class="text-muted">Data belum tersedia...</small>
                                        @else
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi penurunan </small>
                                        @endif
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ number_format($persentase[3], 2) }}%
                                            @if(number_format($persentase[3]) > 0)
                                            <i class="fe-arrow-up font-12 text-success"></i>
                                            @elseif(number_format($persentase[3]) == 0)
                                            <i class="fe-minus font-12 text-black"></i>
                                            @else
                                            <i class="fe-arrow-down font-12 text-danger"></i>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-2 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Mei</h6>
                                        @if(number_format($persentase[4]) > 0)
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi kenaikan </small>
                                        @elseif(number_format($persentase[4]) == 0)
                                        <small class="text-muted">Data belum tersedia...</small>
                                        @else
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi penurunan </small>
                                        @endif
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ number_format($persentase[4], 2) }}%
                                            @if(number_format($persentase[4]) > 0)
                                            <i class="fe-arrow-up font-12 text-success"></i>
                                            @elseif(number_format($persentase[4]) == 0)
                                            <i class="fe-minus font-12 text-black"></i>
                                            @else
                                            <i class="fe-arrow-down font-12 text-danger"></i>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-2 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Juni</h6>
                                        @if(number_format($persentase[5]) > 0)
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi kenaikan </small>
                                        @elseif(number_format($persentase[5]) == 0)
                                        <small class="text-muted">Data belum tersedia...</small>
                                        @else
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi penurunan </small>
                                        @endif
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ number_format($persentase[5], 2) }}%
                                            @if(number_format($persentase[5]) > 0)
                                            <i class="fe-arrow-up font-12 text-success"></i>
                                            @elseif(number_format($persentase[5]) == 0)
                                            <i class="fe-minus font-12 text-black"></i>
                                            @else
                                            <i class="fe-arrow-down font-12 text-danger"></i>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-2 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Juli</h6>
                                        @if(number_format($persentase[6]) > 0)
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi kenaikan </small>
                                        @elseif(number_format($persentase[6]) == 0)
                                        <small class="text-muted">Data belum tersedia...</small>
                                        @else
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi penurunan </small>
                                        @endif
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ number_format($persentase[6], 2) }}%
                                            @if(number_format($persentase[6]) > 0)
                                            <i class="fe-arrow-up font-12 text-success"></i>
                                            @elseif(number_format($persentase[6]) == 0)
                                            <i class="fe-minus font-12 text-black"></i>
                                            @else
                                            <i class="fe-arrow-down font-12 text-danger"></i>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-2 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Agustus</h6>
                                        @if(number_format($persentase[7]) > 0)
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi kenaikan </small>
                                        @elseif(number_format($persentase[7]) == 0)
                                        <small class="text-muted">Data belum tersedia...</small>
                                        @else
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi penurunan </small>
                                        @endif
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ number_format($persentase[7], 2) }}%
                                            @if(number_format($persentase[7]) > 0)
                                            <i class="fe-arrow-up font-12 text-success"></i>
                                            @elseif(number_format($persentase[7]) == 0)
                                            <i class="fe-minus font-12 text-black"></i>
                                            @else
                                            <i class="fe-arrow-down font-12 text-danger"></i>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-2 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">September</h6>
                                        @if(number_format($persentase[8]) > 0)
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi kenaikan </small>
                                        @elseif(number_format($persentase[8]) == 0)
                                        <small class="text-muted">Data belum tersedia...</small>
                                        @else
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi penurunan </small>
                                        @endif
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ number_format($persentase[8], 2) }}%
                                            @if(number_format($persentase[8]) > 0)
                                            <i class="fe-arrow-up font-12 text-success"></i>
                                            @elseif(number_format($persentase[8]) == 0)
                                            <i class="fe-minus font-12 text-black"></i>
                                            @else
                                            <i class="fe-arrow-down font-12 text-danger"></i>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-2 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Oktober</h6>
                                        @if(number_format($persentase[9]) > 0)
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi kenaikan </small>
                                        @elseif(number_format($persentase[9]) == 0)
                                        <small class="text-muted">Data belum tersedia...</small>
                                        @else
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi penurunan </small>
                                        @endif
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ number_format($persentase[9], 2) }}%
                                            @if(number_format($persentase[9]) > 0)
                                            <i class="fe-arrow-up font-12 text-success"></i>
                                            @elseif(number_format($persentase[9]) == 0)
                                            <i class="fe-minus font-12 text-black"></i>
                                            @else
                                            <i class="fe-arrow-down font-12 text-danger"></i>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-2 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">November</h6>
                                        @if(number_format($persentase[10]) > 0)
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi kenaikan </small>
                                        @elseif(number_format($persentase[10]) == 0)
                                        <small class="text-muted">Data belum tersedia...</small>
                                        @else
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi penurunan </small>
                                        @endif
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ number_format($persentase[10], 2) }}%
                                            @if(number_format($persentase[10]) > 0)
                                            <i class="fe-arrow-up font-12 text-success"></i>
                                            @elseif(number_format($persentase[10]) == 0)
                                            <i class="fe-minus font-12 text-black"></i>
                                            @else
                                            <i class="fe-arrow-down font-12 text-danger"></i>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-2 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Desember</h6>
                                        @if(number_format($persentase[11]) > 0)
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi kenaikan </small>
                                        @elseif(number_format($persentase[11]) == 0)
                                        <small class="text-muted">Data belum tersedia...</small>
                                        @else
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi penurunan </small>
                                        @endif
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ number_format($persentase[11], 2) }}%
                                            @if(number_format($persentase[11]) > 0)
                                            <i class="fe-arrow-up font-12 text-success"></i>
                                            @elseif(number_format($persentase[11]) == 0)
                                            <i class="fe-minus font-12 text-black"></i>
                                            @else
                                            <i class="fe-arrow-down font-12 text-danger"></i>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
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

@push('js')
<script>
    var payroll_record = JSON.parse('{!! json_encode($total_payroll) !!}');
    var payroll_tahun_lalu_record = JSON.parse('{!! json_encode($total_payroll_tahun_lalu) !!}');
    var tahun_sekarang = JSON.parse('{!! json_encode($tahun_sekarang) !!}');
    var tahun_lalu = JSON.parse('{!! json_encode($tahun_lalu) !!}');
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<script>
    var config = {
        type: "line",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agust", "Sept", "Oct", "Nov", "Dec"],
            datasets: [{
                    label: tahun_lalu,
                    backgroundColor: '#d63158',
                    borderColor: '#d63158',
                    fill: false,
                    data: payroll_tahun_lalu_record
                },
                {
                    label: tahun_sekarang,
                    backgroundColor: '#397ecc',
                    borderColor: '#397ecc',
                    fill: false,
                    data: payroll_record
                }
            ]
        },
        options: {
            tooltips: {
                callbacks: {
                    label: function(t, d) {
                        var xLabel = d.datasets[t.datasetIndex].label;
                        var yLabel = t.yLabel >= 1000 ? 'Rp ' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : 'Rp ' + t.yLabel;
                        var result = yLabel.length >= 16 ? yLabel.substring(0, 5) : yLabel;
                        return ': ' + yLabel;
                    }
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(value, index, yValues) {
                            if (parseInt(value) >= 1000) {
                                var rupiah = 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                return rupiah.length >= 16 ? rupiah.substring(0, 5) + ' M' : rupiah
                            } else {
                                return 'Rp ' + value;
                            }
                        }
                    }
                }]
            },
            responsive: true,
            title: {
                display: true,
                text: "Line chart payroll " + tahun_lalu + ' & ' + tahun_sekarang
            },
        }
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myLine = new Chart(ctx, config);
    };

    document.getElementById("randomizeData").addEventListener("click", function() {
        config.data.datasets.forEach(function(dataset) {
            dataset.data = dataset.data.map(function() {
                return randomScalingFactor();
            });
        });

        window.myLine.update();
    });
</script>

<script>
    var xValues = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agust", "Sept", "Oct", "Nov", "Dec"];
    var yValues = payroll_record;
    var barColors = [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 206, 86, 0.2)',
    ];
    var borderColor = [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255,99,132,1)',
        'rgba(255, 206, 86, 1)',
    ]

    new Chart("payroll-chart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                borderColor: borderColor,
                data: yValues
            }]
        },
        options: {
            tooltips: {
                callbacks: {
                    label: function(t, d) {
                        var xLabel = d.datasets[t.datasetIndex].label;
                        var yLabel = t.yLabel >= 1000 ? 'Rp ' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : 'Rp ' + t.yLabel;
                        var result = yLabel.length >= 16 ? yLabel.substring(0, 5) : yLabel;
                        return ': ' + yLabel;
                    }
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(value, index, yValues) {
                            if (parseInt(value) >= 1000) {
                                var rupiah = 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                return rupiah.length >= 16 ? rupiah.substring(0, 5) + ' M' : rupiah
                            } else {
                                return 'Rp ' + value;
                            }
                        }
                    }
                }]
            },
            legend: {
                display: false
            },
            title: {
                display: true,
                text: "Grafik payroll tahun " + tahun_sekarang
            }
        }
    });

    var xValues = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agust", "Sept", "Oct", "Nov", "Dec"];
    var yValues = payroll_tahun_lalu_record;
    var barColors = [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 206, 86, 0.2)',
    ];
    var borderColor = [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255,99,132,1)',
        'rgba(255, 206, 86, 1)',
    ]

    new Chart("payroll-chart-tahun-lalu", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                borderColor: borderColor,
                data: yValues
            }]
        },
        options: {
            tooltips: {
                callbacks: {
                    label: function(t, d) {
                        var xLabel = d.datasets[t.datasetIndex].label;
                        var yLabel = t.yLabel >= 1000 ? 'Rp ' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : 'Rp ' + t.yLabel;
                        var result = yLabel.length >= 16 ? yLabel.substring(0, 5) : yLabel;
                        return ': ' + yLabel;
                    }
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(value, index, yValues) {
                            if (parseInt(value) >= 1000) {
                                var rupiah = 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                return rupiah.length >= 16 ? rupiah.substring(0, 5) + ' M' : rupiah
                            } else {
                                return 'Rp ' + value;
                            }
                        }
                    }
                }]
            },
            legend: {
                display: false
            },
            title: {
                display: true,
                text: "Grafik payroll tahun " + tahun_lalu
            }
        }
    });
</script>

@endpush
@endsection