<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="theme-color" content="#6777ef" />
    <meta charset="utf-8" />
    <title>Masuk | Pay Slip </title>
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
            background: url("{{ asset('assets/images/pay_online.svg') }}") no-repeat center center;
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
            height: 600px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-image"></div>
        <div class="login-form">
            <h3 class="text-center">Masuk E-PaySlip VDNI</h3>
            <p class="text-center text-muted">Gunakan email dan kata sandi yang telah terdaftar</p>
            <form class="from-prevent-multiple-submits" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email kamu..." required autocomplete="email" autofocus>
                </div>
                <div class="mb-2">
                    <label for="confirm_password">Kata Sandi</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" minlength="8" placeholder="*******" required>
                        <div class="input-group-append" data-password="false">
                            <div class="input-group-text">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block from-prevent-multiple-submits">Masuk</button>
                </div>
                <div class="text-center mt-2">
                    <a href="{{ route('forget') }}" class="text-muted text-primary">Lupa kata sandi?</a>
                </div>
                <div class="text-center mt-1">
                    <a href="{{ route('register') }}" class="text-muted text-primary">Buat akun</a>
                </div>
                <div class="text-center mt-1">
                    <a href="{{ route('resend_email') }}" class="text-muted text-primary">Belum menerima email?</a>
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

<link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
<link rel="manifest" href="{{ asset('/manifest.json') }}">

<script>
    (function() {
        $('.from-prevent-multiple-submits').on('submit', function() {
            $('.from-prevent-multiple-submits').attr('disabled', 'true');

            // Change the button text
            $(this).find('button[type="submit"]').text('Tunggu sebentar...');
        })
    })();
</script>

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

</html>