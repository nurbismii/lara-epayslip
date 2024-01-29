<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LupaPassword;
use App\Mail\LupaPasswordEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class LupaPasswordController extends Controller
{
    public function index()
    {
        return view('forget_password.index');
    }

    public function store(Request $request)
    {
        $email = $request['email'];
        $token = Str::random(32);
        $cek = User::where('email', $email)->where('status', 'Aktif')->where('level', 'Pengguna')->first();
        if ($cek == null) {
            Alert::error('Error', 'Email tidak terdaftar pada sistem kami, terimakasih :)');
            return redirect()->route('forget');
        }

        $param = [
            'nama' => $cek->name,
            'token' => $token
        ];

        LupaPassword::create([
            'user_id' => $cek->id,
            'token' => $token,
            'status' => 'Aktif'
        ]);

        Mail::to($email)->send(new LupaPasswordEmail($param));
        Alert::success('Sukses', 'Reset kata sandi berhasil silahkan cek inbox email kamu, terimakasih');
        return redirect()->route('login');
    }

    public function konfirmasi($id)
    {
        $cek = LupaPassword::where('token', $id)->where('status', 'Aktif')->first();

        if ($cek == null) {
            return view('email.failed');
        }

        return view('forget_password.reset', compact('cek'));
    }

    public function update_password(Request $request, $id)
    {
        $cek = User::findOrFail($id);

        if ($request['password'] == $request['confirm_password']) {
            $cek->password = Hash::make($request['password']);
            $upd = LupaPassword::findOrFail($request['id_lupa']);
            $upd->status = "Tidak Aktif";
            $upd->update();
            $cek->update();
            Alert::success('Sukses', 'Password Telah Berhasil Di Reset');
            return redirect()->route('login');
        }

        Alert::error('Error', 'Password dan Konfirmasi Password Harus Sama');
        return redirect()->route('konfirmasi.reset', $request['token']);
    }
}
