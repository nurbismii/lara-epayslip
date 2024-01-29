<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfoPengumuman;
use Yajra\DataTables\Datatables;
use Auth;
use Carbon\Carbon;
use Image;
use File;


class InfoPengumumanController extends Controller
{
    public $path;
    public $dimensions;

    public function __construct()
    {
        //DEFINISIKAN PATH
        $this->path = 'images';
        //DEFINISIKAN DIMENSI
        $this->dimensions = ['300', '500'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pengumuman.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg'
        ]);
         //JIKA FOLDERNYA BELUM ADA
         if (!File::isDirectory($this->path)) {
            //MAKA FOLDER TERSEBUT AKAN DIBUAT
            File::makeDirectory($this->path);
        }

        //MENGAMBIL FILE IMAGE DARI FORM
        $file = $request->file('image');
        //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
        Image::make($file)->save($this->path . '/' . $fileName);

        //LOOPING ARRAY DIMENSI YANG DI-INGINKAN
        //YANG TELAH DIDEFINISIKAN PADA CONSTRUCTOR
        foreach ($this->dimensions as $row) {
            //MEMBUAT CANVAS IMAGE SEBESAR DIMENSI YANG ADA DI DALAM ARRAY
            $canvas = Image::canvas($row, $row);
            //RESIZE IMAGE SESUAI DIMENSI YANG ADA DIDALAM ARRAY
            //DENGAN MEMPERTAHANKAN RATIO
            $resizeImage  = Image::make($file)->resize($row, $row, function($constraint) {
                $constraint->aspectRatio();
            });

            //CEK JIKA FOLDERNYA BELUM ADA
            if (!File::isDirectory($this->path . '/' . $row)) {
                //MAKA BUAT FOLDER DENGAN NAMA DIMENSI
                File::makeDirectory($this->path . '/' . $row);
            }

            //MEMASUKAN IMAGE YANG TELAH DIRESIZE KE DALAM CANVAS
            $canvas->insert($resizeImage, 'center');
            //SIMPAN IMAGE KE DALAM MASING-MASING FOLDER (DIMENSI)
            $canvas->save($this->path . '/' . $row . '/' . $fileName);
        }
        $data = [
            'judul' => $request['judul'],
            'description' => $request['description'],
            'image' => $fileName,
            'caption' => $request['caption']
          ];

          return InfoPengumuman::create($data);
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
        $data = InfoPengumuman::findOrFail($id);
        return $data;
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
       $upd = InfoPengumuman::findOrFail($id);
       $upd->judul = $request->judul;
       $upd->description = $request->description;
       $upd->caption = $request->caption;
       if(!empty($request->image)) {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg'
        ]);
         //JIKA FOLDERNYA BELUM ADA
         if (!File::isDirectory($this->path)) {
            //MAKA FOLDER TERSEBUT AKAN DIBUAT
            File::makeDirectory($this->path);
        }

        //MENGAMBIL FILE IMAGE DARI FORM
        $file = $request->file('image');
        //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
        Image::make($file)->save($this->path . '/' . $fileName);

        //LOOPING ARRAY DIMENSI YANG DI-INGINKAN
        //YANG TELAH DIDEFINISIKAN PADA CONSTRUCTOR
        foreach ($this->dimensions as $row) {
            //MEMBUAT CANVAS IMAGE SEBESAR DIMENSI YANG ADA DI DALAM ARRAY
            $canvas = Image::canvas($row, $row);
            //RESIZE IMAGE SESUAI DIMENSI YANG ADA DIDALAM ARRAY
            //DENGAN MEMPERTAHANKAN RATIO
            $resizeImage  = Image::make($file)->resize($row, $row, function($constraint) {
                $constraint->aspectRatio();
            });

            //CEK JIKA FOLDERNYA BELUM ADA
            if (!File::isDirectory($this->path . '/' . $row)) {
                //MAKA BUAT FOLDER DENGAN NAMA DIMENSI
                File::makeDirectory($this->path . '/' . $row);
            }

            //MEMASUKAN IMAGE YANG TELAH DIRESIZE KE DALAM CANVAS
            $canvas->insert($resizeImage, 'center');
            //SIMPAN IMAGE KE DALAM MASING-MASING FOLDER (DIMENSI)
            $canvas->save($this->path . '/' . $row . '/' . $fileName);
        }
        $upd->image = $fileName;
      }
      $upd->update();
      return $upd;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InfoPengumuman::destroy($id);
    }

    public function api()
    {

        $nmr = '1';
        $pengumuman = InfoPengumuman::all();
        return Datatables::of($pengumuman)
         ->addColumn('action', function($pengumuman) {
           if(Auth::user()->level == "Administrator") {
            return
           '<a onclick="edit_pengumuman('. $pengumuman->id .')"  class="btn btn-outline-blue waves-effect waves-light"><i class="mdi mdi-pencil"></i><b> Ubah </b></a> ' .
           '<a onclick="delete_pengumuman('. $pengumuman->id .')" class="btn btn-outline-danger waves-effect waves-light"><i class="mdi mdi-close mr-1"></i><b> Hapus </b></a>';
        }
        })
        ->addColumn('gambar', function($pengumuman) {
            return '<img src="images/500/'.$pengumuman->image .'" width="50px" height="50px">';
        })
        ->rawColumns(['gambar', 'action'])->make(true);
    }
}
