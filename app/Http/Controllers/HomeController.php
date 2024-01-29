<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKaryawan;
use App\Models\User;
use App\Models\InfoPengumuman;
use DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = DB::table('users')
                    ->where('level', 'Pengguna')
                    ->count();
        $karyawan = DB::table('data_karyawans')->count();
        $pengumuman = InfoPengumuman::orderBy('id', 'DESC')->limit(4)->get();
        return view('home.index', compact('user','karyawan','pengumuman'));
    }
}
