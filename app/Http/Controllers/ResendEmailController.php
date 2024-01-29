<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ResendEmail;
use App\Mail\RegisterEmail;
use Illuminate\Support\Facades\Mail;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ResendEmailController extends Controller
{
    public function index()
    {
        return view('resend_email.index');
    }

    public function store(Request $request)
    {
        $data = User::where('email', $request['email'])->where('token', '!=', '')->first();

        if ($data == NULL) {
            Alert::error('Error', 'Opps, Terjadi Kesalahan. Terimakasih');
            return redirect()->route('resend_email');
        }

        if ($data->level == "Pengguna") {

            $cek = ResendEmail::where('user_id', $data->id)->first();

            if ($cek == NULL) {
                ResendEmail::create([
                    'user_id' => $data->id,
                    'waktu' => date('Y-m-d H:i:s')
                ]);
                $param = [
                    'nama' => $data->name,
                    'token' => $data->token
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
                    'nama' => $data->name,
                    'token' => $data->token
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
