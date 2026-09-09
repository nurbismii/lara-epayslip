@extends('layouts.app')
@section('content')
@include('slip_gaji._styles')
<style>
    .slip-shell { max-width: 960px; margin: 24px auto; }
    .slip-toolbar { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 16px; }
    .slip-toolbar h4 { margin: 0 0 5px; }
    .slip-paper { background: white; padding: 32px; border: 1px solid #e5eaf0; border-radius: 8px; box-shadow: 0 4px 18px rgba(25, 45, 60, .05); }
    .slip-paper .payslip { font-size: 12px; }
    .slip-paper .ps-items td { font-size: 11px; }
    @media (max-width: 600px) {
        .slip-toolbar { align-items: stretch; flex-direction: column; }
        .slip-paper { padding: 16px; }
        .slip-paper .ps-columns, .slip-paper .ps-columns > tbody, .slip-paper .ps-columns > tbody > tr, .slip-paper .ps-column { display: block; width: 100%; padding: 0; }
        .slip-paper .ps-logo { max-width: 110px; height: auto; max-height: 36px; }
        .slip-paper .ps-total td { font-size: 12px; }
    }
</style>
<div class="content"><div class="container-fluid"><div class="slip-shell">
    <div class="slip-toolbar">
        <div><h4>Slip Gaji</h4><div class="text-muted">Rincian penghasilan dan potongan gaji karyawan.</div></div>
        <form id="downloadForm" action="{{ Auth::user()->level == 'Administrator' ? route('salary.cetak_pdf') : route('cetak.slip_gaji', $cek->periode) }}" method="{{ Auth::user()->level == 'Administrator' ? 'POST' : 'GET' }}">
            @if(Auth::user()->level == 'Administrator')
                @csrf
                <input type="hidden" name="month" value="{{ $cek->periode }}">
                <input type="hidden" name="karyawan_id" value="{{ $cek->data_karyawan_id }}">
            @endif
            <button id="downloadButton" class="btn btn-primary" type="submit"><i class="mdi mdi-download mr-1"></i> Unduh PDF</button>
        </form>
    </div>
    <div id="downloadStatus" role="status" aria-live="polite" class="mb-3" hidden></div>
    <div class="slip-paper">@include('slip_gaji._document')</div>
</div></div></div>
<script>
document.getElementById('downloadForm').addEventListener('submit', async function (event) {
    event.preventDefault();
    const button = document.getElementById('downloadButton');
    const status = document.getElementById('downloadStatus');
    if (button.disabled) return;
    button.disabled = true;
    button.setAttribute('aria-busy', 'true');
    button.textContent = 'Menyiapkan PDF...';
    status.hidden = false;
    status.className = 'alert alert-info mb-3';
    status.textContent = 'PDF sedang disiapkan. Mohon tunggu.';
    try {
        const options = { method: this.method.toUpperCase(), credentials: 'same-origin', headers: { Accept: 'application/pdf' } };
        if (options.method === 'POST') options.body = new FormData(this);
        const response = await fetch(this.action, options);
        if (!response.ok || !(response.headers.get('Content-Type') || '').includes('application/pdf')) {
            throw new Error('PDF gagal diunduh. Muat ulang halaman dan pastikan sesi login serta data slip masih tersedia.');
        }
        const blob = await response.blob();
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = 'Slip-Gaji-{{ $cek->periode }}.pdf';
        document.body.appendChild(link);
        link.click();
        link.remove();
        setTimeout(() => URL.revokeObjectURL(url), 60000);
        status.className = 'alert alert-success mb-3';
        status.textContent = 'PDF siap. Periksa unduhan pada browser Anda.';
    } catch (error) {
        status.className = 'alert alert-danger mb-3';
        status.textContent = error.message || 'Terjadi gangguan saat mengunduh PDF. Silakan coba lagi.';
    } finally {
        button.disabled = false;
        button.removeAttribute('aria-busy');
        button.textContent = 'Unduh PDF';
    }
});
</script>
@endsection
