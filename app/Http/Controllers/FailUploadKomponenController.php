<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FailUploadKomponen;

class FailUploadKomponenController extends Controller
{
    public function index()
    {
        $data = FailUploadKomponen::all();
        return view('data_fail_upload.index', compact('data'));
    }
}
