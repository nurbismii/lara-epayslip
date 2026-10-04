@php
$employee = $cek->data_karyawan;
$company = strtoupper(trim($employee->nm_perusahaan ?? ''));
$month = \Carbon\Carbon::parse($cek->periode . '-01')->locale('id');
$start = $cek->mulai_periode ? \Carbon\Carbon::parse($cek->mulai_periode) : $month->copy()->subMonth()->day(16);
$end = $cek->akhir_periode ? \Carbon\Carbon::parse($cek->akhir_periode) : $month->copy()->day(15);
$logos = ['VDNI' => 'logo-vdni.png', 'VDNIP' => 'vdnip-logo.png'];
$logoPath = isset($logos[$company]) ? resource_path('images/' . $logos[$company]) : null;
$logo = $logoPath && is_readable($logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) : null;

$earnings = [
'gaji_pokok' => 'Gaji pokok',
'tunj_um' => 'Tunjangan uang makan',
'tunj_pengawas' => 'Tunjangan pengawas',
'tunj_koefisien' => 'Tunjangan koefisien jabatan',
'tunj_mk' => 'Tunjangan masa kerja',
'tunj_transport' => 'Tunjangan transport & pulsa',
'tunj_fungsional' => 'Tunjangan fungsional',
'tunj_lap' => 'Tunjangan lapangan',
'ot' => 'Lembur',
'hm' => 'Hour machine',
'insentif' => 'Insentif',
'kompensasi' => 'Kompensasi',
'rapel' => 'Rapel',
'bonus' => 'Bonus',
'thr' => 'Tunjangan hari raya',
];

$deductions = [
'jht' => 'BPJS TK JHT',
'jp' => 'BPJS TK JP',
'pot_bpjskes' => 'BPJS Kesehatan',
'unpaid_leave' => 'Deduction unpaid leave',
'deduction_alpa' => 'Deduction alpa',
'deduction' => 'Deduction',
'deduction_pph21' => 'Deduction PPH 21',
];
@endphp
<div class="payslip">
    <table class="ps-header">
        <tr>
            <td>
                @if($logo)<img class="ps-logo" src="{{ $logo }}" alt="Logo {{ $company }}">@endif
                <div class="ps-company">{{ $company ? 'PT ' . $company : 'Slip Gaji Karyawan' }}</div>
            </td>
            <td class="ps-right">
                <div class="ps-confidential">PRIBADI DAN RAHASIA</div>
                <h1>Slip Gaji</h1>
                <div class="ps-month">{{ $month->translatedFormat('F Y') }}</div>
            </td>
        </tr>
    </table>
    <div class="ps-period">Periode kerja: {{ $start->locale('id')->translatedFormat('d F Y') }} - {{ $end->locale('id')->translatedFormat('d F Y') }}</div>
    <table class="ps-info">
        <tr>
            <td><span>Nama karyawan</span><strong>{{ $employee->nama }}</strong></td>
            <td><span>NIK</span><strong>{{ $employee->nik }}</strong></td>
        </tr>
        <tr>
            <td><span>Departemen / Divisi</span>{{ $cek->departemen ?: '-' }} / {{ $cek->divisi ?: '-' }}</td>
            <td><span>Posisi</span>{{ $cek->posisi ?: '-' }}</td>
        </tr>
        <tr>
            <td><span>Status gaji</span>{{ $cek->status_gaji ?: '-' }}</td>
            <td><span>Hari kerja / Hour machine</span>{{ $cek->jml_hari_kerja ?? 0 }} hari / {{ $cek->jml_hour_machine ?? 0 }} jam</td>
        </tr>
    </table>
    <table class="ps-columns">
        <tr>
            @foreach(['Penghasilan' => $earnings, 'Potongan' => $deductions] as $title => $fields)
            <td class="ps-column">
                <h2>{{ $title }}</h2>
                <table class="ps-items">
                    <thead>
                        <tr>
                            <th>Rincian</th>
                            <th class="ps-right">Jumlah (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $hasRows = false; @endphp
                        @foreach($fields as $field => $label)
                        @if($field === 'gaji_pokok' || (float) ($cek->$field ?? 0) != 0)
                        @php $hasRows = true; @endphp
                        <tr>
                            <td>{{ $label }}</td>
                            <td class="ps-amount">{{ number_format((float) ($cek->$field ?? 0), 0, ',', '.') }}</td>
                        </tr>
                        @endif
                        @endforeach
                        @if(!$hasRows)<tr>
                            <td colspan="2" class="ps-muted">Tidak ada potongan.</td>
                        </tr>@endif
                    </tbody>
                </table>
            </td>
            @endforeach
        </tr>
    </table>
    <div class="ps-note">Durasi surat peringatan: {{ $cek->durasi_sp && $cek->durasi_sp > '2015-01-01' ? getTanggalIndo($cek->durasi_sp) : '-' }}</div>
    <table class="ps-total">
        <tr>
            <td>Total diterima</td>
            <td class="ps-right">Rp {{ number_format((float) ($cek->tot_diterima ?? 0), 0, ',', '.') }}</td>
        </tr>
    </table>
    <table class="ps-footer">
        <tr>
            <td><span>DITRANSFER KE</span><strong>{{ $cek->bank_name ?: '-' }} · {{ $cek->bank_number ?: '-' }}</strong>
                <div>{{ $employee->nama }}</div>
            </td>
            <td class="ps-right">
                <div>Morosi{{ $cek->tanggal_gajian ? ', ' . getTanggalIndo($cek->tanggal_gajian) : '' }}</div><span>DIBUAT OLEH</span><strong>Payroll</strong>
            </td>
        </tr>
    </table>
    <div class="ps-bottom">Dokumen ini memuat informasi penggajian pribadi. Simpan dan gunakan secara bijak.</div>
</div>