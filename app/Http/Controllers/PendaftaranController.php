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
        $cek_nik = DataKaryawan::where('nik', $request['nik'])->first();

        if ($cek_nik == null) {
            Alert::error('Gagal', 'Maaf NIK yang kamu masukkan tidak terdaftar');
            return redirect()->route('register');
        }

        if ($cek_nik) {
            if ($cek_nik->tgl_lahir != $request['tgl_lahir']) {
                Alert::error('Gagal', 'Maaf tanggal lahir yang kamu masukkan tidak sesuai, harap lapor ke kantor HRD');
                return back();
            }
        }

        $cek_ktp = DataKaryawan::where('no_ktp', $request['no_ktp'])->first();

        if ($cek_ktp == null) {
            Alert::error('Gagal', 'Maaf nomor KTP yang kamu masukkan tidak terdaftar');
            return redirect()->route('register');
        }

        $cek_data = DataKaryawan::where('nik', $request['nik'])->where('no_ktp', $request['no_ktp'])->where('tgl_lahir', $request['tgl_lahir'])->first();

        if ($cek_data == NULL) {
            Alert::error('Gagal', 'Maaf kamu belum terdaftar pada sistem kami!!!');
            return redirect()->route('register');
        }

        if ($request['password'] != $request['confirm_password']) {
            Alert::error('Gagal', 'Maaf kata sandi dan konfirmasi kata sandi harus sama');
            return redirect()->route('register');
        }

        $email = $request['email'];
        $password = Hash::make($request['password']);
        $status = "Tidak Aktif";
        $token = Str::random(32);
        $level = "Pengguna";
        $karyawan_id = $cek_data->id;

        $cek_user = User::where('email', $email)->orWhere('data_karyawan_id', $karyawan_id)->first();

        $cek_token = User::where('token', $token)->first();

        if ($cek_token == null && $cek_user == null) {

            User::create([
                'name' => $cek_data->nama,
                'email' => $email,
                'password' => $password,
                'level' => $level,
                'status' => $status,
                'data_karyawan_id' => $karyawan_id,
                'token' => $token
            ]);

            $param = [
                'nama' => $cek_data->nama,
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
