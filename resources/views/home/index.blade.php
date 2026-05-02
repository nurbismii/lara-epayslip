@extends('layouts.app')

@push('css')
<link href="{{ versioned_asset('assets/css/dashboard-modern.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
@php
    $currentUser = Auth::user();
    $employee = $currentUser->karyawan;
    $salaryComponent = $currentUser->komponenGaji;
    $displayName = trim($currentUser->name ?: 'User');
    $nameParts = preg_split('/\s+/', $displayName);
    $initials = '';

    foreach (array_slice($nameParts, 0, 2) as $part) {
        if ($part !== '') {
            $initials .= strtoupper(substr($part, 0, 1));
        }
    }

    $initials = $initials ?: 'U';
    $firstName = $nameParts[0] ?? $displayName;
    $position = optional($salaryComponent)->posisi ?: 'Posisi belum diisi';
    $department = optional($salaryComponent)->departemen ?: 'Departemen belum diisi';
    $division = optional($salaryComponent)->divisi ?: 'Divisi belum diisi';
    $period = optional($salaryComponent)->periode ?: 'Belum tersedia';

    $profileFields = [
        'NIK' => optional($employee)->nik ?: '-',
        'Departemen' => $department,
        'Divisi' => $division,
        'Posisi' => $position,
        'BPJS Kesehatan' => optional($employee)->bpjs_ket ?: '-',
        'BPJS TK' => optional($employee)->bpjs_tk ?: '-',
    ];
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

        <div class="row">
            <div class="col-xl-4 mb-4">
                <aside class="profile-card h-100">
                    <div class="profile-card-top">
                        <div class="profile-avatar">{{ $initials }}</div>
                        <div>
                            <h5 class="profile-name">{{ $displayName }}</h5>
                            <p class="profile-role">{{ $position }}</p>
                        </div>
                    </div>

                    <div class="profile-grid">
                        @foreach($profileFields as $label => $value)
                            <div class="profile-field">
                                <span>{{ $label }}</span>
                                <strong>{{ $value }}</strong>
                            </div>
                        @endforeach
                    </div>

                    <div class="profile-note">
                        <i class="mdi mdi-file-document-outline"></i>
                        <span>Periode payroll terakhir: {{ $period }}</span>
                    </div>
                </aside>
            </div>

            <div class="col-xl-8">
                <section class="dashboard-section mt-0">
                    <div class="dashboard-section-header">
                        <div>
                            <h5 class="dashboard-section-title">Pengumuman HR</h5>
                            <p class="dashboard-section-subtitle">Informasi terbaru dari perusahaan untuk seluruh karyawan.</p>
                        </div>
                    </div>

                    <div class="row">
                        @forelse($pengumuman as $p)
                            <div class="col-md-6 mb-3">
                                @include('home.partials.announcement-card', ['announcement' => $p])
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="dashboard-empty">
                                    <i class="mdi mdi-bullhorn-outline"></i>
                                    <span>Belum ada pengumuman yang tersedia saat ini.</span>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
