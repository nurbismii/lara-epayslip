<!DOCTYPE html>
<html lang="id" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">

<head>
    <meta name="viewport" content="width=device-width" />
    <meta charset="UTF-8" />
    <title>Reset Password - Pay Slip</title>
</head>

<body style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
    <table class="body-wrap" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
        <tr>
            <td valign="top"></td>
            <td class="container" width="600" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; display: block !important; max-width: 600px !important; margin: 0 auto;">
                <div class="content" style="padding: 20px;">
                    <table class="main" width="100%" cellpadding="0" cellspacing="0" style="border-radius: 3px; background-color: #fff; margin: 0; border: 3px solid #4fc6e1;">
                        <tr>
                            <td class="content-wrap" style="padding: 30px; border-radius: 7px; background-color: #fff;">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="text-align: center">
                                            <a href="{{ asset('assets/images/logo-dark.png') }}">
                                                <img src="{{ asset('assets/images/logo-dark.png') }}" height="24" alt="PaySlip Logo" />
                                            </a>
                                            <br /><br />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Silahkan klik tombol di bawah untuk reset password Anda.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Kami mengirimkan email ini karena permintaan reset password dari Anda. Jika Anda tidak pernah meminta reset password, silakan abaikan email ini. Terima kasih.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            <a href="{{ route('konfirmasi.reset', $inputs['token']) }}" class="btn-primary" style="color: #FFF; text-decoration: none; font-weight: bold; text-align: center; background-color: #6658dd; border-radius: 5px; padding: 10px 20px; border: none; display: inline-block;">Reset Password</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Jika tidak bisa, silakan klik link berikut atau copy dan paste di browser: <br>
                                            <a href="{{ route('konfirmasi.reset', $inputs['token']) }}">{{ route('konfirmasi.reset', $inputs['token']) }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            <b>Sistem</b> - PaySlip VDNI
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <div class="footer" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-align: center; margin-top: 20px;">
                        <p>PaySlip VDNI, Morosi, Indonesia</p>
                    </div>
                </div>
            </td>
            <td valign="top"></td>
        </tr>
    </table>
</body>

</html>