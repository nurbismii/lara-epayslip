<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Excel;
use App\Imports\NonaktifPengguna;
use Yajra\DataTables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

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
    public function index(Request $request)
    {
        if ($request->ajax()) {

            if ((Auth::user()->level == "Administrator")) {
                $data = User::join('data_karyawans', 'users.data_karyawan_id', '=', 'data_karyawans.id')->select('data_karyawans.nik', 'users.*')->where('level', 'pengguna');
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    if (Auth::user()->level == "Administrator") {
                        return view('user._aksi', [
                            'data' => $data,
                            'edit' => route('user.edit', $data->id),
                            'destroy' => route('user.destroy', $data->id),
                        ]);
                    }
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->where('name', 'LIKE', "%$search%");
                            $w->Orwhere('nik', 'LIKE', "%$search%");
                            $w->Orwhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('user.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::where('id', $id)->first();
        return view('user.edit', compact('data'));
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
        try {
            $user = User::findOrFail($id);
            $user->status = $request['status'];
            $user->update();
            Alert::success('Berhasil', 'Perbarui data pengguna berhasil dilakukan');
            return redirect('user');
        } catch (\Throwable $e) {
            Alert::error('Opps', 'Terjadi kesalahan');
            return back();
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
        $data = User::where('id', $id)->first();

        if ($data) {
            $data->delete();
            Alert::success('Berhasil', 'Data pengguna berhasil dihapus');
            return back();
        }

        Alert::error('Opps', 'Data tidak dapat terjadi perubahan data');
        return back();
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
            if ($import->failures()->isNotEmpty()) {
                return redirect()->back()->withFailures($import->failures());
            }

            return redirect()->back()->withStatus('File Excel Berhasil Di Upload');
        }
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }
}
