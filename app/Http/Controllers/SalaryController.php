<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKaryawan;
use App\Models\KomponenGaji;
use App\Jobs\ProsesImportSalary;
use PDF;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
    public function index(Request $request)
    {
        if ($request->ajax()) {

            if ((Auth::user()->level == "Administrator")) {
                $data = KomponenGaji::join('data_karyawans', 'data_karyawans.id', '=', 'komponen_gajis.data_karyawan_id')->select('komponen_gajis.*', 'data_karyawans.nama', 'data_karyawans.nik');
            }

            if ($request->filled('periode')) {
                $data = $data->where('periode', $request->periode);
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    return view('salary._aksi', [
                        'data' => $data,
                        'detail_salary' => route('detail.salary', $data->id),
                    ]);
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->where('nama', 'LIKE', "%$search%");
                            $w->Orwhere('nik', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('salary.index');
    }

    public function show($id)
    {
        if (Auth::user()->level == "Administrator") {
            $cek = KomponenGaji::findOrFail($id);
            return view('slip_gaji.slip', compact('cek'));
        }
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

    public function uploadSalary()
    {
        return view('salary.upload-salary');
    }

    public function upload(Request $request)
    {
        try {
            //VALIDASI
            $this->validate($request, [
                'file' => 'required|mimes:xls,xlsx'
            ]);

            if ($request->hasFile('file')) {

                DB::beginTransaction();

                DB::table('fail_upload_komponens')->delete();
                $file = Storage::putFile('public', $request->file('file'));

                ProsesImportSalary::dispatch($file);

                DB::commit();
                Alert::success('Sukses', 'File berhasil diupload, file sedang diproses dibelakang layar');
                return back();
            }
            return redirect()->back()->with(['error' => 'Please choose file before']);
        } catch (\Throwable $e) {
            DB::rollBack();
            Alert::error('Gagal', 'Terjadi kesalahan saat proses upload');
            return redirect()->back();
        }
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
        return $pdf->download('Slip-Gaji-' . date("F-Y", strtotime($periode)) . '.pdf');
    }

    public function delete_all(Request $request)
    {
        DB::table('komponen_gajis')->where('periode', '=', $request['periode'])->delete();
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect()->route('salary.index');
    }
}
