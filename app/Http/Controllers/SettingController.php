<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Datatables;
use Auth;
use Alert;


class SettingController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function my_account()
    {
        $pengguna = User::where('id',Auth::user()->id)->first();
        return view('pengguna.setting', compact('pengguna'));
    }

    public function update(Request $request, $id)
    {
        $upd = User::findOrFail($id);
        $upd->name = $request['nama'];
        $upd->email = $request['email'];
        if(!empty($request['password'])) {
            $upd->password = Hash::make($request['password']);
        }
        if($request['email'] == $request['email_lm']){
           $upd->update();
           Alert::success('Sukses', 'Data Akun Berhasil Diperbarui');
           return redirect()->route('pengguna.akun');
        } else {
            $cek = User::where('email',$request['email'])->first();
            if($cek === Null) {
                $upd->update();
                Alert::success('Sukses', 'Data Akun Berhasil Diperbarui');
                return redirect()->route('pengguna.akun');
            } else {
                Alert::error('Gagal', 'Data Akun Gagal Diperbarui, Email Telah Digunakan');
                return redirect()->route('pengguna.akun');
            }
        }
    }
}
