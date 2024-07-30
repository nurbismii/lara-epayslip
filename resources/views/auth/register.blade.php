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

    <style>
        .login-container {
            display: flex;
            flex-wrap: wrap;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }

        .login-image,
        .login-form {
            width: 100%;
            max-width: 600px;
        }

        .login-image {
            background: url("{{ asset('assets/images/register_online.svg') }}") no-repeat center center;
            background-size: cover;
            height: 400px;
        }

        .login-form {
            max-width: 400px;
            padding: 2rem;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .form-control,
        .btn {
            border-radius: 8px;
        }

        .btn-primary {
            background-color: #6a5acd;
            border-color: #6a5acd;
        }

        .btn-primary:hover {
            background-color: greenyellow;
            border-color: greenyellow;
        }

        /* Media Queries for Responsive Design */
        @media (min-width: 768px) {
            .login-image {
                flex: 0 0 60%;
                height: auto;
            }

            .login-form {
                flex: 0 0 40%;
            }
        }

        @media (max-width: 767px) {
            .login-image {
                display: none;
            }
        }

        /* Fallback color for image */
        .login-image::after {
            content: '';
            display: block;
            background: "#e0e0e0";
            height: 490px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-image"></div>
        <div class="login-form">
            <h3 class="text-center">Daftar E-PaySlip VDNI</h3>
            <p class="text-center text-muted">Untuk Pendaftaran Silahkan Isi Form Di Bawah. Pastikan Data Kamu Valid.</p>
            <form class="from-prevent-multiple-submits" method="POST" action="{{ route('pendaftaran') }}">
                @csrf
                <div class="mb-2">
                    <label for="nik">NIK Karyawan</label>
                    <input class="form-control @error('nik') is-invalid @enderror" type="text" name="nik" value="{{ old('nik') }}" id="nik" placeholder="Masukkan Nik Anda" required autofocus>
                </div>
                <div class="mb-2">
                    <label for="no_ktp">No KTP</label>
                    <input class="form-control @error('no_ktp') is-invalid @enderror" type="text" name="no_ktp" value="{{ old('no_ktp') }}" id="no_ktp" placeholder="Masukkan No KTP Anda" required>
                </div>
                <div class="mb-2">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input class="form-control @error('tgl_lahir') is-invalid @enderror" type="date" name="tgl_lahir" value="{{ old('tgl_lahir') }}" id="tgl_lahir" placeholder="Masukkan Tangga Lahir Anda" required>
                </div>
                <div class="mb-2">
                    <label for="email">Email</label>
                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" id="email" placeholder="Masukkan Alamat Email Anda" required>
                </div>
                <div class="mb-2">
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
                <div class="mb-3">
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
                <div class="d-grid">
                    <button class="btn btn-primary btn-block from-prevent-multiple-submits" type="submit"> Daftar </button>
                </div>
                <div class="text-center mt-3">
                    <p>Sudah punya akun? <a href="{{ route('login') }}" class="text-muted text-primary">Masuk</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

@include('sweetalert::alert')
<!-- Vendor js -->
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<!-- App js -->
<script src="{{ asset('assets/js/app.min.js') }}"></script>

<script src="{{ asset('/sw.js') }}"></script>
<script>
    if ("serviceWorker" in navigator) {
        // Register a service worker hosted at the root of the
        // site using the default scope.
        navigator.serviceWorker.register("/sw.js").then(
            (registration) => {
                console.log("Service worker registration succeeded:", registration);
            },
            (error) => {
                console.error(`Service worker registration failed: ${error}`);
            },
        );
    } else {
        console.error("Service workers are not supported.");
    }
</script>

<script>
    (function() {
        $('.from-prevent-multiple-submits').on('submit', function(event) {
            // Prevent multiple submissions
            $('.from-prevent-multiple-submits').attr('disabled', true);

            // Change the button text
            $(this).find('button[type="submit"]').text('Data sedang diproses...');
        });
    })();
</script>

</html>