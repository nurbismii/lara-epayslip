<?php

namespace App\Imports;

use App\Models\User;
use App\Models\DataKaryawan;
use App\Models\FailUploadKomponen;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;

class NonaktifPengguna implements ToModel, WithHeadingRow, SkipsOnError, withValidation, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    private $niks;
    private $row = 2;

    public function __construct()
    {
        $this->niks = DataKaryawan::select('id','nik','no_ktp')->get();
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $karyawan = $this->niks->where('nik', $row['nik'])->where('no_ktp', $row['no_ktp'])->first();
        if($karyawan === null) {
            FailUploadKomponen::create([
                'baris' => $this->row,
                'nik' => $row['nik'],
                'no_ktp' => $row['no_ktp'],
            ]);
        } else {
            $upd = User::where('data_karyawan_id', $karyawan->id)->first();
            $upd->status = $row['status'];
            $upd->update();
       }
    }
    
    public function rules(): array
    {
        return [
            '*.nik' => ['required'],
            '*.no_ktp' => ['required'],
            '*.status' => ['required']
        ];
    }
}
