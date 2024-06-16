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

            <div class="col-md-6 col-lg-8">
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
                        <canvas id="canvas_pay" style="width:100%;max-width:800px" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
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
                        <canvas id="canvas_emp" style="width:100%;max-width:800px" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 col-xl-4 order-0">
                <div class="card">
                    <h5 class="fw-bold text-center">Selisih upah {{ $tahun_lalu }} & {{ $tahun_sekarang }}</h5>
                    <div class="card-body">
                        <ul class="p-0 m-0">
                            @php
                            $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            @endphp
                            @for($i=0; $i < count($persentase); $i++) @if(number_format($persentase[$i])==0) @break @endif <li class="d-flex mb-2">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-1">{{ $months[$i] }}</h6>
                                        @if(number_format($persentase[$i]) > 0)
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi kenaikan </small> <br>
                                        @elseif(number_format($persentase[$i]) == 0)
                                        <small class="text-muted">Data belum tersedia...</small>
                                        @else
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi penurunan </small>
                                        @endif
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ number_format($persentase[$i], 2) }}%
                                            @if(number_format($persentase[$i]) > 0)
                                            <i class="fe-arrow-up font-12 text-success"> <br>
                                                <small class="text-muted fw-bold">{{ konversiNumber($selisih[$i]) }} </small>
                                            </i>
                                            @elseif(number_format($persentase[$i]) == 0)
                                            <i class="fe-minus font-12 text-black"></i>
                                            @else
                                            <i class="fe-arrow-down font-12 text-danger">
                                                <br>
                                                <small class="text-muted fw-bold">{{ konversiNumber($selisih[$i]) }} </small>
                                            </i>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                                </li>
                                @endfor
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <h5 class="fw-bold text-center">Selisih karyawan {{ $tahun_lalu }} & {{ $tahun_sekarang }}</h5>
                    <div class="card-body">
                        <ul class="p-0 m-0">
                            @php
                            $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            @endphp
                            @for($i=0; $i < count($persentase_selisih_karyawan); $i++) @if(number_format($persentase_selisih_karyawan[$i])==0) @break @endif <li class="d-flex mb-2">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-1">{{ $months[$i] }}</h6>
                                        @if(number_format($persentase_selisih_karyawan[$i]) > 0)
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi kenaikan </small> <br>
                                        @elseif(number_format($persentase_selisih_karyawan[$i]) == 0)
                                        <small class="text-muted">Data belum tersedia...</small>
                                        @else
                                        <small class="text-muted">{{ $tahun_sekarang }} terjadi penurunan </small>
                                        @endif
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ number_format($persentase_selisih_karyawan[$i], 2) }}%
                                            @if(number_format($persentase_selisih_karyawan[$i]) > 0)
                                            <i class="fe-arrow-up font-12 text-success"> <br>
                                                <small class="text-muted fw-bold">{{ konversiNumber($selisih_karyawan[$i]) }} karyawan</small>
                                            </i>
                                            @elseif(number_format($persentase_selisih_karyawan[$i]) == 0)
                                            <i class="fe-minus font-12 text-black"></i>
                                            @else
                                            <i class="fe-arrow-down font-12 text-danger">
                                                <br>
                                                <small class="text-muted fw-bold">{{ konversiNumber($selisih_karyawan[$i]) }} karyawan</small>
                                            </i>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                                </li>
                                @endfor
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
    var total_karyawan = JSON.parse('{!! json_encode($total_karyawan) !!}');
    var total_karyawan_tahun_lalu = JSON.parse('{!! json_encode($total_karyawan_tahun_lalu) !!}');
    var tahun_sekarang = JSON.parse('{!! json_encode($tahun_sekarang) !!}');
    var tahun_lalu = JSON.parse('{!! json_encode($tahun_lalu) !!}');
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="{{ asset('assets/js/lineChart.js') }}"></script>

@endpush
@endsection