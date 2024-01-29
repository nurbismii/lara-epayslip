<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Datatables;
use Auth;

class PenggunaController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pengguna.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama = $request['nama'];
        $email = $request['email'];
        $password = Hash::make($request['password']);
        $level = $request['level'];
        $status = $request['status'];

        $cek = User::where('email',$request['email'])->first();
        if($cek === Null){
            $simpan =  User::create([
                'name' => $nama,
                'email' => $email,
                'password' => $password,
                'status' => $status,
                'level' => $level,
              ]);
            return $simpan;
        } else {
            return $simpan;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->level == "Administrator") {
            $data = User::findOrFail($id);
            return $data;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $upd = User::findOrFail($id);
        $upd->name = $request['nama'];
        $upd->email = $request['email'];
        $upd->status = $request['status'];
        $upd->level = $request['level'];
        if(!empty($request['password'])) {
            $upd->password = Hash::make($request['password']);
        }
        if($request['email'] == $request['email_lm']){
            return $upd->update();
        } else {
            $cek = User::where('email',$request['email'])->first();
            if($cek === Null) {
                return $upd->update();
            } else {
                return $upds->update();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->level == "Administrator") {
            User::destroy($id);
          } else {
            Alert::error('Gagal', 'Oops, Hayoo Mau ngapain ???');
            return redirect()->route('warga.index');
         }
    }

    public function api()
    {
        $nmr = '1';
        $user = User::where('level','Administrator')
                    ->where('id','!=',Auth::user()->id)
                    ->get();
        return Datatables::of($user)
         ->addColumn('action', function($user) {
           if(Auth::user()->level == "Administrator") {
            return
           '<a onclick="edit_pengguna('. $user->id .')"  class="btn btn-outline-blue waves-effect waves-light"><i class="mdi mdi-pencil"></i><b> Ubah </b></a> ' .
           '<a onclick="delete_pengguna('. $user->id .')" class="btn btn-outline-danger waves-effect waves-light"><i class="mdi mdi-close mr-1"></i><b> Hapus </b></a>';
        }
        })
        ->make(true);
    }
}
