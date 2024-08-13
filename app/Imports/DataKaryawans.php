<?php

namespace App\Imports;

use App\Models\DataKaryawan;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Carbon;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class DataKaryawans implements ToModel, WithHeadingRow, SkipsOnError, withValidation, SkipsOnFailure, WithChunkReading, WithBatchInserts
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
            'npwp' => str_replace(array('.', '-'), '', $row['no_npwp']),
            'tgl_lahir' => Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_lahir'])),
            'nm_perusahaan' => $row['nm_perusahaan'],
            'bpjs_ket' => strval($row['no_bpjs_kes']),
            'bpjs_tk' => strval($row['no_bpjs_tk']),
            'vaksin_1' => $row['vaksin'],
            'tgl_join' =>  Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_join'])),
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function rules(): array
    {
        return [
            '*.nik' => ['required', 'unique:data_karyawans,nik'],
            '*.no_ktp' => ['required', 'unique:data_karyawans,no_ktp'],
        ];
    }
}
