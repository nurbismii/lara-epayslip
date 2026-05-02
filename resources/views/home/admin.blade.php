@extends('layouts.app')

@push('css')
<link href="{{ asset('assets/css/dashboard-modern.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
@php
    $stats = [
        [
            'label' => 'Total Data Karyawan',
            'value' => $karyawan,
            'note' => 'Data master aktif',
            'icon' => 'fe-users',
            'tone' => 'tone-info',
        ],
        [
            'label' => 'Pengguna Aktif',
            'value' => $user_aktif,
            'note' => 'Akun siap digunakan',
            'icon' => 'fe-user-check',
            'tone' => 'tone-primary',
        ],
        [
            'label' => 'Pengguna Tidak Aktif',
            'value' => $user_nonaktif,
            'note' => 'Perlu peninjauan',
            'icon' => 'fe-user-x',
            'tone' => 'tone-warning',
        ],
        [
            'label' => 'Antrian File',
            'value' => $list_queue,
            'note' => 'Upload/import tertunda',
            'icon' => 'fe-upload-cloud',
            'tone' => 'tone-success',
        ],
    ];

    $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
@endphp

<div class="content dashboard-modern">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>

        <div class="dashboard-hero dashboard-hero-admin">
            <div>
                <span class="dashboard-kicker">Dashboard HR</span>
                <h3>Ringkasan operasional e-PaySlip</h3>
                <p>Pantau data karyawan, status pengguna, payroll, antrian upload, dan pengumuman terbaru dari satu tempat.</p>
            </div>

            <form action="{{ route('home') }}" method="get" class="dashboard-year-form">
                <label for="tahun" class="sr-only">Tahun payroll</label>
                <select name="tahun" id="tahun" class="form-control">
                    @for($year = max((int) date('Y') + 1, (int) $tahun_sekarang); $year >= 2021; $year--)
                        <option value="{{ $year }}" {{ (string) $year === (string) $tahun_sekarang ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endfor
                </select>
                <button type="submit" class="btn btn-light">
                    <i class="mdi mdi-filter-variant mr-1"></i>Terapkan
                </button>
                <a href="{{ route('home') }}" class="btn btn-outline-light">
                    Reset
                </a>
            </form>
        </div>

        <div class="row">
            @foreach($stats as $stat)
                <div class="col-sm-6 col-xl-3">
                    <div class="dashboard-stat {{ $stat['tone'] }}">
                        <div class="dashboard-stat-header">
                            <div>
                                <div class="dashboard-stat-value">
                                    <span data-plugin="counterup">{{ $stat['value'] }}</span>
                                </div>
                                <p class="dashboard-stat-label">{{ $stat['label'] }}</p>
                            </div>
                            <span class="dashboard-stat-icon">
                                <i class="{{ $stat['icon'] }}"></i>
                            </span>
                        </div>
                        <span class="dashboard-stat-note">{{ $stat['note'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-xl-8 mb-4">
                <section class="dashboard-panel h-100">
                    <div class="dashboard-panel-header">
                        <div>
                            <h5 class="dashboard-panel-title">Tren Total Upah Pokok</h5>
                            <p class="dashboard-panel-subtitle">Perbandingan payroll {{ $tahun_lalu }} dan {{ $tahun_sekarang }} per bulan.</p>
                        </div>
                        <span class="dashboard-stat-note">Tahun {{ $tahun_sekarang }}</span>
                    </div>
                    <div class="dashboard-chart-wrap">
                        <canvas id="canvas_pay" class="dashboard-chart chartjs-render-monitor"></canvas>
                    </div>
                </section>
            </div>

            <div class="col-xl-4 mb-4">
                <section class="dashboard-panel h-100">
                    <div class="dashboard-panel-header">
                        <div>
                            <h5 class="dashboard-panel-title">Selisih Upah</h5>
                            <p class="dashboard-panel-subtitle">Perubahan nilai payroll dibanding tahun sebelumnya.</p>
                        </div>
                    </div>

                    <div class="payroll-delta-list">
                        @php $payrollDeltaCount = 0; @endphp

                        @for($i = 0; $i < count($months); $i++)
                            @php
                                $percentage = isset($persentase[$i]) ? (float) $persentase[$i] : 0;
                                $difference = isset($selisih[$i]) ? $selisih[$i] : 0;
                                $formattedPercentage = number_format($percentage, 2);
                            @endphp

                            @if($formattedPercentage === '0.00')
                                @continue
                            @endif

                            @php
                                $payrollDeltaCount++;
                                $isUp = $percentage > 0;
                            @endphp

                            <div class="payroll-delta-item">
                                <div>
                                    <div class="payroll-delta-month">{{ $months[$i] }}</div>
                                    <p class="payroll-delta-copy">
                                        {{ $tahun_sekarang }} {{ $isUp ? 'naik' : 'turun' }}
                                        sebesar {{ konversiNumber($difference) }}
                                    </p>
                                </div>
                                <span class="payroll-delta-value {{ $isUp ? 'is-up' : 'is-down' }}">
                                    <i class="{{ $isUp ? 'fe-arrow-up' : 'fe-arrow-down' }} mr-1"></i>{{ $formattedPercentage }}%
                                </span>
                            </div>
                        @endfor

                        @if($payrollDeltaCount === 0)
                            <div class="dashboard-empty">
                                <i class="mdi mdi-chart-line"></i>
                                <span>Belum ada selisih payroll yang bisa ditampilkan untuk tahun ini.</span>
                            </div>
                        @endif
                    </div>
                </section>
            </div>
        </div>

        <section class="dashboard-section">
            <div class="dashboard-section-header">
                <div>
                    <h5 class="dashboard-section-title">Pengumuman Terbaru</h5>
                    <p class="dashboard-section-subtitle">Ringkasan informasi yang tampil untuk karyawan.</p>
                </div>
                <a href="{{ route('info-pengumuman.index') }}" class="btn btn-primary btn-sm">
                    <i class="mdi mdi-plus-circle-outline mr-1"></i>Kelola Pengumuman
                </a>
            </div>

            <div class="row">
                @forelse($pengumuman as $p)
                    <div class="col-md-6 col-xl-3 mb-3">
                        @include('home.partials.announcement-card', ['announcement' => $p])
                    </div>
                @empty
                    <div class="col-12">
                        <div class="dashboard-empty">
                            <i class="mdi mdi-bullhorn-outline"></i>
                            <span>Belum ada pengumuman yang tersedia.</span>
                        </div>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</div>

@push('js')
<script>
    var payroll_record = @json($total_payroll);
    var payroll_tahun_lalu_record = @json($total_payroll_tahun_lalu);
    var total_karyawan = @json($total_karyawan);
    var total_karyawan_tahun_lalu = @json($total_karyawan_tahun_lalu);
    var tahun_sekarang = @json($tahun_sekarang);
    var tahun_lalu = @json($tahun_lalu);
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="{{ asset('assets/js/lineChart.js') }}"></script>
@endpush
@endsection
