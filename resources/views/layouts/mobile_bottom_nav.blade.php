@auth
@php
    $isAdmin = Auth::user()->level === 'Administrator';

    $items = $isAdmin
        ? [
            [
                'label' => 'Dashboard',
                'icon' => 'mdi mdi-view-dashboard-outline',
                'url' => route('home'),
                'active' => ['home', 'masaKerja', 'bpjs-tk'],
            ],
            [
                'label' => 'Karyawan',
                'icon' => 'mdi mdi-account-group-outline',
                'url' => route('karyawan.index'),
                'active' => ['karyawan.*'],
            ],
            [
                'label' => 'Gaji',
                'icon' => 'mdi mdi-file-document-outline',
                'url' => route('salary.index'),
                'active' => ['salary.*'],
            ],
            [
                'label' => 'Info',
                'icon' => 'mdi mdi-bullhorn-outline',
                'url' => route('info-pengumuman.index'),
                'active' => ['info-pengumuman.*'],
            ],
            [
                'label' => 'Akun',
                'icon' => 'mdi mdi-account-circle-outline',
                'url' => route('pengguna.akun'),
                'active' => ['pengguna.akun', 'update.akun'],
            ],
        ]
        : [
            [
                'label' => 'Dashboard',
                'icon' => 'mdi mdi-view-dashboard-outline',
                'url' => route('home'),
                'active' => ['home'],
            ],
            [
                'label' => 'Slip',
                'icon' => 'mdi mdi-clipboard-text-outline',
                'url' => route('slip_gaji'),
                'active' => ['slip_gaji', 'search.slip_gaji', 'cetak.slip_gaji'],
            ],
            [
                'label' => 'Profil',
                'icon' => 'mdi mdi-card-account-details-outline',
                'url' => route('profile'),
                'active' => ['profile'],
            ],
            [
                'label' => 'Nilai',
                'icon' => 'mdi mdi-bookmark-check-outline',
                'url' => route('detail_penilaian'),
                'active' => ['detail_penilaian', 'detail_evaluasi', 'detail_hasil_evaluasi'],
            ],
            [
                'label' => 'Akun',
                'icon' => 'mdi mdi-account-circle-outline',
                'url' => route('pengguna.akun'),
                'active' => ['pengguna.akun', 'update.akun'],
            ],
        ];
@endphp

<nav class="mobile-bottom-nav" aria-label="Navigasi cepat mobile">
    @foreach($items as $item)
        @php
            $isActive = collect($item['active'])->contains(function ($routeName) {
                return request()->routeIs($routeName);
            });
        @endphp

        <a
            href="{{ $item['url'] }}"
            class="mobile-bottom-nav__item {{ $isActive ? 'is-active' : '' }}"
            aria-current="{{ $isActive ? 'page' : 'false' }}"
        >
            <i class="{{ $item['icon'] }}" aria-hidden="true"></i>
            <span>{{ $item['label'] }}</span>
        </a>
    @endforeach
</nav>
@endauth
