<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ResendEmail;
use App\Mail\RegisterEmail;
use Illuminate\Support\Facades\Mail;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class ResendEmailController extends Controller
{
    public function index()
    {
        return view('resend_email.index');
    }

    public function store(Request $request)
    {
        $data = User::where('email', $request['email'])->first();
        $data_upd = '';

        if ($data == NULL) {
            Alert::error('Error', 'Opps, email yang kamu masukkan tidak terdaftar pada sistem kami!!!');
            return redirect()->route('resend_email');
        }

        if ($data->token == '') {
            $token = Str::random(32);
            $data->update([
                'token' => $token
            ]);
            $data_upd = User::where('email', $request['email'])->first();
        }

        if ($data_upd->level == "Pengguna") {

            $cek = ResendEmail::where('user_id', $data_upd->id)->first();

            if ($cek == NULL) {
                ResendEmail::create([
                    'user_id' => $data_upd->id,
                    'waktu' => date('Y-m-d H:i:s')
                ]);
                $param = [
                    'nama' => $data_upd->name,
                    'token' => $token
                ];
                Mail::to($request['email'])->send(new RegisterEmail($param));
                Alert::success('Sukses', 'Email Berhasil Dikirim. Silahkan Cek folder Inbox Email atau Folder Spam Email Anda. Terimakasih');
                return redirect()->route('login');
            }

            $awal = strtotime($cek->waktu);
            $akhir = strtotime(date('Y-m-d H:i:s'));
            $diff = $akhir - $awal;

            $jam = floor($diff / (60 * 60));
            $menit = ($diff - ($jam * (60 * 60))) / 60;
            $detik = $diff % 60;
            //dd($menit);
            if (($jam > 0) || ($menit > 45)) {
                $param = [
                    'nama' => $data_upd->name,
                    'token' => $data_upd->token
                ];
                $cek->waktu = date('Y-m-d H:i:s');
                $cek->update();
                Mail::to($request['email'])->send(new RegisterEmail($param));
                Alert::success('Sukses', 'Email Berhasil Dikirim. Silahkan Cek folder Inbox Email atau Folder Spam Email Anda. Terimakasih');
                return redirect()->route('login');
            }
            Alert::warning('Harap bersabar', 'Cek email anda secara berkala, jika 30 menit kedapan belum ada email masuk silahkan gunakan fitur kirim ulang email. Terimakasih');
            return redirect()->route('login');
        }
        Alert::error('Error', 'Opps, Terjadi Kesalahan.');
        return redirect()->route('resend_email');
    }
}
