@extends('lupa_akun.layout')
@section('title', 'Lupa Akun')
@section('content')
    <p>Tidak dapat mengakses email lama atau lupa kata sandi? Masukkan data sesuai NIK karyawan, tanggal lahir dan NO KTP</p>
    <form method="POST" action="{{ route('lupa_akun.store') }}">
        @csrf
        <div class="form-group">
            <label for="nik">NIK Karyawan</label>
            <input type="text" id="nik" name="nik" class="form-control" maxlength="255" required autofocus autocomplete="off" value="{{ old('nik') }}">
        </div>
        <div class="form-group">
            <label for="tgl_lahir">Tanggal Lahir</label>
            <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" max="{{ now()->subDay()->toDateString() }}" required value="{{ old('tgl_lahir') }}">
        </div>
        <div class="form-group">
            <label for="no_ktp">No. KTP</label>
            <input type="text" id="no_ktp" name="no_ktp" class="form-control" inputmode="numeric" pattern="[0-9]{16}" minlength="16" maxlength="16" required autocomplete="off" aria-describedby="ktp-help">
            <small id="ktp-help" class="form-text text-muted">Masukkan 16 digit nomor KTP sesuai data HRD.</small>
        </div>
        <div class="form-group">
            <label for="email">Email Baru</label>
            <input type="email" id="email" name="email" class="form-control" maxlength="255" required autocomplete="email" value="{{ old('email') }}" aria-describedby="email-help">
            <small id="email-help" class="form-text text-muted">Gunakan email yang belum terdaftar. Tautan untuk membuat kata sandi baru akan dikirim ke alamat ini.</small>
        </div>
        <p class="text-muted">Akun lama tetap berlaku sampai pemulihan selesai. Untuk akun yang dinonaktifkan admin atau data yang tidak sesuai, hubungi HRD.</p>
        <button type="submit" class="btn btn-primary btn-block">Kirim Tautan Pemulihan</button>
    </form>
    <p class="text-center mt-3 mb-0">Masih dapat mengakses email lama? <a href="{{ route('forget') }}">Lupa kata sandi</a></p>
@endsection
