<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KomponenGaji;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
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
        $data = KomponenGaji::where('data_karyawan_id', Auth::user()->data_karyawan->id)
        ->orderby('periode', 'desc')
        ->first();

        return view('profile.index', compact('data'));
    }
}
