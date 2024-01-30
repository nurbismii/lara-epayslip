<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> Pendaftaran | Pay Slip </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="E-PaySlip PT Virtue Dragon Nickel Industry" name="description" />
    <meta content="E-PaySlip" name="HR-SITE" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/icon.png') }}">

    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap-creative.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('assets/css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="{{ asset('assets/css/bootstrap-creative-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{ asset('assets/css/app-creative-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="loading authentication-bg authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <div class="auth-logo">
                                    <a href="index.html" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('assets/images/logo-vdni.png') }}" alt="" height="44">
                                        </span>
                                    </a>

                                    <a href="index.html" class="logo logo-light text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('assets/images/logo-vdni.png') }}" alt="" height="44">
                                        </span>
                                    </a>
                                </div>
                                <p class="text-muted mb-4 mt-3">Untuk Pendaftaran Silahkan Isi Form Di Bawah. Pastikan Data Anda Valid. </p>
                            </div>

                            <form method="POST" action="{{ route('pendaftaran') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="nik">NIK </label>
                                    <input class="form-control @error('nik') is-invalid @enderror" type="text" name="nik" value="{{ old('nik') }}" id="nik" placeholder="Masukkan Nik Anda" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="no_ktp">No KTP</label>
                                    <input class="form-control @error('no_ktp') is-invalid @enderror" type="text" name="no_ktp" value="{{ old('no_ktp') }}" id="no_ktp" placeholder="Masukkan No KTP Anda" required>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input class="form-control @error('tgl_lahir') is-invalid @enderror" type="date" name="tgl_lahir" value="{{ old('tgl_lahir') }}" id="tgl_lahir" placeholder="Masukkan Tangga Lahir Anda" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" id="email" placeholder="Masukkan Alamat Email Anda" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Kata Sandi</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" minlength="8" placeholder="Masukkan Kata Sandi Anda" required>
                                        <div class="input-group-append" data-password="false">
                                            <div class="input-group-text">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Konfirmasi Kata Sandi</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" minlength="8" placeholder="Masukkan Ulang Kata Sandi Anda" required>
                                        <div class="input-group-append" data-password="false">
                                            <div class="input-group-text">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-success btn-block" type="submit"> Daftar </button>
                                </div>

                            </form>


                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-white-50">Sudah Punya Akun? <a href="{{ route('login') }}" class="text-white ml-1"><b>Masuk</b></a></p>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->
    @include('sweetalert::alert')
    <footer class="footer footer-alt text-white-50">
        <script>
            document.write(new Date().getFullYear())
        </script> by <a href="" class="text-white-50">IT VDNI</a>
    </footer>

    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
</body>

</html>