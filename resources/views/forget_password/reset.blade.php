<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="theme-color" content="#6777ef" />
    <meta charset="utf-8" />
    <title>Lupa kata sandi | Pay Slip </title>
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
            background: url("{{ asset('assets/images/my_password.svg') }}") no-repeat center center;
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
            <h3 class="text-center">Atur Ulang Kata Sandi</h3>
            <p class="text-center text-muted">Silahkan masukkan kata sandi baru kamu</p>
            <form method="POST" action="{{ route('update.password', $cek->user_id) }}">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="token" value="{{ $cek->token }}">
                <input type="hidden" name="id_lupa" value="{{ $cek->id }}">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ $cek->user->email }}" id="email" required readonly>
                </div>
                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" minlength="8" placeholder="Masukkan Kata Sandi Anda">
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
                        <input type="password" id="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" minlength="8" placeholder="Masukkan Ulang Kata Sandi Anda">
                        <div class="input-group-append" data-password="false">
                            <div class="input-group-text">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-0 text-center">
                    <button class="btn btn-primary btn-block" type="submit"> Kirim </button>
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

<script>
    (function() {
        $('.from-prevent-multiple-submits').on('submit', function() {
            $('.from-prevent-multiple-submits').attr('disabled', 'true');

            // Change the button text
            $(this).find('button[type="submit"]').text('Tunggu sebentar...');
        })
    })();
</script>

</html>