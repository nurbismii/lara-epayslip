<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKaryawan;
use App\Models\KomponenGaji;
use App\Imports\SalaryKaryawans;
use PDF;
use Yajra\DataTables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class SalaryController extends Controller
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
        if (Auth::user()->level == "Administrator") {
            $periode = date('Y-m');
            $data = KomponenGaji::where('periode', $periode)->get();
            return view('salary.index', compact('data'));
        }
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
        if (Auth::user()->level == "Administrator") {
            $cek = KomponenGaji::findOrFail($id);
            return view('slip_gaji.slip', compact('cek'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function api()
    {
        $nmr = '1';
        $karyawan = DataKaryawan::all();
        return Datatables::of($karyawan)
            ->addColumn('action', function ($karyawan) {
                if (Auth::user()->level == "Administrator") {
                    return
                        '<a onclick="edit_karyawan(' . $karyawan->id . ')"  class="btn btn-outline-blue waves-effect waves-light"><i class="mdi mdi-pencil"></i><b> Ubah </b></a> ' .
                        '<a onclick="delete_karyawan(' . $karyawan->id . ')" class="btn btn-outline-danger waves-effect waves-light"><i class="mdi mdi-close mr-1"></i><b> Hapus </b></a>';
                }
            })
            ->make(true);
    }

    public function upload(Request $request)
    {

        //VALIDASI
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            DB::table('fail_upload_komponens')->delete();
            $file = $request->file('file')->store('import'); //GET FILE
            $import = new SalaryKaryawans;
            $import->import($file);

            if ($import->failures()->isNotEmpty()) {
                return redirect()->back()->withFailures($import->failures());
            }
            return redirect()->back()->withStatus('File Excel Berhasil Di Upload');
        }
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }

    public function search(Request $request)
    {
        $periode = $request['month'];
        $data = KomponenGaji::where('periode', $periode)->get();
        return view('salary.search', compact('data', 'periode'));
    }

    public function hasil_pdf(Request $request)
    {
        $periode = $request['month'];
        $cek = KomponenGaji::where('data_karyawan_id', $request['karyawan_id'])
            ->where('periode', $periode)
            ->first();

        $pdf = PDF::loadview('slip_gaji.slip-pdf', ['cek' => $cek]);
        return $pdf->stream();
    }

    public function delete_all(Request $request)
    {
        DB::table('komponen_gajis')->where('periode', '=', $request['periode'])->delete();
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect()->route('salary.index');
    }
}
