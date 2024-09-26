<!DOCTYPE html>
<html lang="id" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">

<head>
    <meta name="viewport" content="width=device-width" />
    <meta charset="UTF-8" />
    <title>Konfirmasi - Pay Slip</title>
</head>

<body style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; line-height: 1.6em; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
    <table class="body-wrap" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
        <tr>
            <td></td>
            <td class="container" width="600" style="display: block; max-width: 600px; margin: 0 auto;">
                <div class="content" style="padding: 20px;">
                    <table class="main" width="100%" cellpadding="0" cellspacing="0" style="border-radius: 3px; background-color: #fff; margin: 0; border: 3px solid #4fc6e1;" bgcolor="#fff">
                        <tr>
                            <td class="content-wrap" style="padding: 30px; border-radius: 7px;">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="text-align: center;">
                                            <a href="{{ route('home') }}" style="display: block; margin-bottom: 10px;">
                                                <img src="{{ asset('assets/images/logo-dark.png') }}" height="24" alt="Logo Pay Slip VDNI" />
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block" style="padding: 0 0 20px;">
                                            Hai {{$inputs['nama']}}, hanya beberapa langkah lagi sebelum kamu dapat menggunakan akun Anda.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block" style="padding: 0 0 20px;">
                                            Silakan klik tombol di bawah ini untuk memverifikasi email Anda.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block" style="padding: 0 0 20px; text-align: center;">
                                            <a href="{{ route('pendaftaran.verifikasi', $inputs['token']) }}" class="btn-primary" style="color: #FFF; background-color: #6658dd; border-color: #6658dd; border-style: solid; border-width: 8px 16px; text-decoration: none; font-weight: bold; text-align: center; display: inline-block; border-radius: 5px;">Konfirmasi Email</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block" style="padding: 0 0 20px;">
                                            Jika tidak bisa, silakan klik link berikut atau salin dan tempel di browser Anda: <br />
                                            <a href="{{ route('pendaftaran.verifikasi', $inputs['token']) }}">{{ route('pendaftaran.verifikasi', $inputs['token']) }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block" style="padding: 0 0 20px;">
                                            <b>Sistem</b> - Pay Slip VDNI
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <div class="footer" style="width: 100%; clear: both; color: #999; padding: 20px; text-align: center;">
                        <table width="100%">
                            <tr>
                                <td class="aligncenter content-block" style="font-size: 12px; color: #999; text-align: center;">
                                    &copy; <script>
                                        document.write(new Date().getFullYear())
                                    </script> Pay Slip VDNI
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </td>
            <td></td>
        </tr>
    </table>
    <div class="footer" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-align: center; margin-top: 20px;">
        <p>PaySlip VDNI, Morosi, Indonesia</p>
    </div>
</body>

</html>