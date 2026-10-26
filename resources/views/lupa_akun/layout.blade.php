<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="referrer" content="no-referrer">
    <title>@yield('title') | E-PaySlip</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/icon.png') }}">
    <link href="{{ versioned_asset('assets/css/bootstrap-creative.min.css') }}" rel="stylesheet">
    <link href="{{ versioned_asset('assets/css/app-creative.min.css') }}" rel="stylesheet">
    <style>
        body { background: #f3f5fa; }
        .recovery-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px 16px; }
        .recovery-card { width: 100%; max-width: 460px; padding: 32px; background: #fff; border-radius: 12px; box-shadow: 0 4px 24px rgba(0,0,0,.08); }
        .recovery-card .btn, .recovery-card .form-control { border-radius: 8px; }
        .btn-primary { background-color: #6a5acd; border-color: #6a5acd; }
        .btn-primary:hover { background-color: greenyellow; border-color: greenyellow; }
    </style>
</head>
<body>
    <main class="recovery-container">
        <div class="recovery-card">
            <h1 class="h3 text-center">@yield('title')</h1>
            <p class="text-center text-muted">E-PaySlip VDNI</p>
            @if(session('status'))
                <div class="alert alert-success" role="status">{{ session('status') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0 pl-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
            <p class="text-center mt-3 mb-0"><a href="{{ route('login') }}">Kembali ke halaman masuk</a></p>
        </div>
    </main>
</body>
</html>
