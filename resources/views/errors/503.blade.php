<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pemberitahuan Perpindahan Alamat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Auto Redirect 5 Detik -->
    <meta http-equiv="refresh" content="5;url=https://epayslip.vdnisite.com">
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1d7135ff, #3739c3ff);
            font-family: Arial, Helvetica, sans-serif;
            color: #fff;
            text-align: center;
        }

        .container {
            max-width: 520px;
            padding: 40px;
        }

        h1 {
            font-size: 34px;
            margin-bottom: 12px;
        }

        p {
            font-size: 16px;
            opacity: 0.95;
            line-height: 1.6;
        }

        a {
            color: #ffe082;
            font-weight: bold;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .icon {
            font-size: 60px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="icon">👋</div>
        <h1>Kami Pindah Alamat!</h1>
        <p>
            Halo! 👋<br><br>
            Layanan <strong>ePayslip</strong> sekarang bisa diakses melalui
            alamat baru berikut :<br><br>

            <a href="https://epayslip.vdnisite.com">
                https://epayslip.vdnisite.com
            </a><br><br>

            Jangan khawatir, kami akan mengarahkan Anda secara otomatis.
        </p>

        <div class="countdown">
            Mengalihkan halaman dalam
            <span id="time">5</span> detik...
        </div>
    </div>

    <script>
        let timeLeft = 5;
        const timeEl = document.getElementById('time');

        const countdown = setInterval(() => {
            timeLeft--;
            timeEl.textContent = timeLeft;

            if (timeLeft <= 0) {
                clearInterval(countdown);
            }
        }, 1000);
    </script>
</body>

</html>