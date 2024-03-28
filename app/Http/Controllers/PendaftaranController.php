<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DataKaryawan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\RegisterEmail;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class PendaftaranController extends Controller
{
    public function pendaftaran(Request $request)
    {
        $karyawan = DataKaryawan::where('nik', $request->nik)->first();

        if (!$karyawan) {
            return redirect()->route('register')->with('error', 'Maaf, NIK yang Anda masukkan tidak terdaftar.');
        }

        if ($karyawan->tgl_lahir != $request->tgl_lahir) {
            return redirect()->route('register')->with('error', 'Maaf, tanggal lahir yang Anda masukkan tidak sesuai. Harap laporkan ke HRD.');
        }

        if ($karyawan->no_ktp != $request->no_ktp) {
            return redirect()->route('register')->with('error', 'Maaf, No KTP yang kamu masukkan tidak sesuai dengan data kami. Silahkan laporkan ini ke HRD');
        }

        if ($request->password !== $request->confirm_password) {
            return redirect()->route('register')->with('error', 'Maaf, kata sandi dan konfirmasi kata sandi harus sama.');
        }

        $exist_user = User::where('email', $request->email)->orWhere('data_karyawan_id', $karyawan->id)->first();

        if ($exist_user) {
            return redirect()->route('register')->with('error', 'Maaf, data Anda telah terdaftar dalam sistem kami.');
        }

        $email = $request['email'];
        $password = Hash::make($request['password']);
        $status = "Tidak Aktif";
        $token = Str::random(32);
        $level = "Pengguna";
        $karyawan_id = $karyawan->id;

        $cek_token = User::where('token', $token)->first();

        if ($cek_token == null && $exist_user == null) {

            User::create([
                'name' => $karyawan->nama,
                'email' => $email,
                'password' => $password,
                'level' => $level,
                'status' => $status,
                'data_karyawan_id' => $karyawan_id,
                'token' => $token
            ]);

            $param = [
                'nama' => $karyawan->nama,
                'token' => $token
            ];

            Mail::to($email)->send(new RegisterEmail($param));
            Alert::success('Sukses', 'Pendaftaran Berhasil Silahkan Cek folder Inbox Email atau Folder Spam Email Anda. Terimakasih');
            return redirect()->route('login');
        }

        Alert::error('info', 'Data kamu telah terdaftar disistem kami');
        return redirect()->route('register');
    }

    public function verifikasi($id)
    {
        $cek = User::where('token', $id)->first();

        if ($cek === null) {
            return view('email.failed');
        }

        if ($cek->level == "Pengguna") {
            $cek->status = "Aktif";
            $cek->token = "";
            $cek->update();
            return view('email.verifikasi');
        }

        return view('email.failed');
    }
}
