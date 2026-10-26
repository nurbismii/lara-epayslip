@extends('lupa_akun.layout')
@section('title', 'Pulihkan Akun')
@section('content')
    <p>Buat kata sandi baru untuk menyelesaikan verifikasi email dan pemulihan akun.</p>
    <div class="alert alert-info">Email baru: <strong>{{ $recovery->email }}</strong></div>
    <form method="POST" action="{{ route('lupa_akun.update', $token) }}">
        @csrf
        <div class="form-group">
            <label for="password">Kata Sandi Baru</label>
            <input type="password" id="password" name="password" class="form-control" minlength="8" maxlength="72" required autocomplete="new-password" aria-describedby="password-help">
            <small id="password-help" class="form-text text-muted">Gunakan 8–72 karakter.</small>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" minlength="8" maxlength="72" required autocomplete="new-password">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Simpan dan Pulihkan Akun</button>
    </form>
@endsection
