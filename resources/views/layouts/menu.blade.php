<!--- Sidemenu -->
<div id="sidebar-menu">

    <ul id="side-menu">

        <li class="menu-title">Menu</li>
        <li>
            <a href="{{ route('home') }}">
                <i class="mdi mdi-view-dashboard-outline"></i>
                <span> Dashboards </span>
            </a>
        </li>
        @if(Auth::user()->level == "Administrator")
        <li>
            <a href="{{ route('user.index') }}">
                <i class="mdi mdi-account-multiple-outline"></i>
                <span> Data Pengguna </span>
            </a>
        </li>

        <li>
            <a href="{{ route('karyawan.index') }}">
                <i class="mdi mdi-bookmark-multiple-outline"></i>
                <span> Data Karyawan </span>
            </a>
        </li>
        <li>
            <a href="#sidebarFormsPayslip" data-toggle="collapse">
                <i data-feather="credit-card"></i>
                <span> Data Slip Gaji </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarFormsPayslip">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{ route('salary.index') }}">Slip Gaji</a>
                    </li>
                    <li>
                        <a href="/upload-salary">Upload Slip Gaji</a>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <a href="#sidebarForms" data-toggle="collapse">
                <i data-feather="bookmark"></i>
                <span> Penilaian Karyawan </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarForms">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{ route('pencapaian-kinerja.index') }}">Evaluasi Kinerja dan Pencapaian Kerja</a>
                    </li>
                    <li>
                        <a href="{{ route('evaluasi-ketangakerjaan.index') }}">Evaluasi Ketenagakerjaan</a>
                    </li>
                    <li>
                        <a href="{{ route('hasil-evaluasi.index') }}">Hasil Evaluasi</a>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <a href="{{ route('data_tertolak') }}">
                <i class="mdi mdi-upload"></i>
                <span> Data Tertolak </span>
            </a>
        </li>
        <li>
            <a href="{{ route('info-pengumuman.index') }}">
                <i data-feather="message-square"></i>
                <span> Pengumuman </span>
            </a>
        </li>
        <li>
            <a href="{{ route('pengguna.index') }}">
                <i class="mdi mdi-account-circle-outline"></i>
                <span> Administrator </span>
            </a>
        </li>


        @endif
        @if(Auth::user()->level == "Pengguna")
        <li>
            <a href="{{ route('profile') }}">
                <i class="mdi mdi-account-circle-outline"></i>
                <span> Profile </span>
            </a>
        </li>
        <li>
            <a href="{{ route('slip_gaji') }}">
                <i class="mdi mdi-clipboard-multiple-outline"></i>
                <span> Slip Gaji </span>
            </a>
        </li>
        <li>
            <a href="#sidebarForms" data-toggle="collapse">
                <i data-feather="bookmark"></i>
                <span> Penilaian Karyawan </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarForms">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{ route('detail_penilaian') }}">Evaluasi Kinerja dan Pencapaian Kerja</a>
                    </li>
                    <li>
                        <a href="{{ route('detail_evaluasi') }}">Evaluasi Ketenagakerjaan</a>
                    </li>
                    <li>
                        <a href="{{ route('detail_hasil_evaluasi') }}">Hasil Evaluasi</a>
                    </li>
                </ul>
            </div>
        </li>
        @endif
    </ul>
</div>
</li>
</ul>

</div>