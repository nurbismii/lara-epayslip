<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Excel;
use App\Imports\NonaktifPengguna;
use App\Jobs\ImportJob;
use Yajra\DataTables\Datatables;
use Auth;
use DB;

class UserController extends Controller
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
        return view('user.index');
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
        //
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
        $user = User::findOrFail($id);
        $user['nik'] = $user->data_karyawan->nik;

        return $user;
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
        $user = User::findOrFail($id);
        $user->status = $request['status'];
        $user->update();
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
    }

    public function api()
    {
        $nmr = '1';
        $user = User::where('level','Pengguna')
                    ->get();
        return Datatables::of($user)
         ->addColumn('action', function($user) {
           if(Auth::user()->level == "Administrator") {
            return
           '<a onclick="edit_user('. $user->id .')"  class="btn btn-outline-blue waves-effect waves-light"><i class="mdi mdi-pencil"></i><b> Ubah </b></a> ' .
           '<a onclick="delete_user('. $user->id .')" class="btn btn-outline-danger waves-effect waves-light"><i class="mdi mdi-close mr-1"></i><b> Hapus </b></a>';
        }
        })
        ->addColumn('nik', function($user) {
            return $user->data_karyawan->nik;
        })
        ->make(true);
    }

    public function nonaktifkan_pengguna(Request $request)
    {
         //VALIDASI
         $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            DB::table('fail_upload_komponens')->delete();
            $file = $request->file('file')->store('import'); //GET FILE
            $import = new NonaktifPengguna;
            $import->import($file);
            if($import->failures()->isNotEmpty()){
                return redirect()->back()->withFailures($import->failures());
            }

            return redirect()->back()->withStatus('File Excel Berhasil Di Upload');
        }
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }
}
