<?php

namespace App\Imports;
use App\Models\DataKaryawan;
use App\Models\KomponenGaji;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;
use Carbon;


class DataKaryawans implements ToModel, WithHeadingRow, SkipsOnError, withValidation, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DataKaryawan([
            'nik' => $row['nik'],
            'no_ktp' => $row['no_ktp'],
            'nama' => $row['nama'],
            'npwp' => $row['no_npwp'],
            'tgl_lahir' => Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_lahir'])),
            'nm_perusahaan' => $row['nm_perusahaan'],
            'bpjs_ket' => $row['no_bpjs_kes'],
            'bpjs_tk' => $row['no_bpjs_tk'],
            'vaksin_1' => $row['vaksin'],
            'tgl_join' =>  Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_join'])),
        ]);
    }

    public function rules(): array
    {
        return [
            '*.nik' => ['required', 'unique:data_karyawans,nik'],
            '*.no_ktp' => ['required', 'unique:data_karyawans,no_ktp'],
        ];
    }


}
