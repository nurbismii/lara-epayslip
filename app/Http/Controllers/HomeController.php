<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKaryawan;
use App\Models\User;
use App\Models\InfoPengumuman;
use Illuminate\Support\Facades\DB;


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
        $user_aktif = User::where('level', 'Pengguna')->where('status', 'Aktif')->count();
        $user_nonaktif = User::where('level', 'Pengguna')->where('status', 'Tidak Aktif')->count();
        $karyawan = DB::table('data_karyawans')->count();
        $list_queue = DB::table('jobs')->count();
        $pengumuman = InfoPengumuman::orderBy('id', 'DESC')->limit(4)->get();

        return view('home.index', compact('user_aktif', 'list_queue', 'user_nonaktif', 'karyawan', 'pengumuman'));
    }
}
