<?php

namespace App\Exports;

use App\Models\DataKaryawan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KaryawanExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DataKaryawan::where('status_karyawan', NULL)->select('*')->get();
    }

    public function headings(): array
    {
        return [
            'NIK',
            'NO KTP',
            'NAMA',
            'TGL LAHIR',
            'AREA',
            'BPJS KES',
            'BPJS TK',
            'NPWP',
            'VAKSIN',
            'TGL JOIN',
        ];
    }

    public function map($row): array
    {
        return [
            $row['nik'],
            "'" . $row['no_ktp'],
            $row['nama'],
            $row['tgl_lahir'],
            $row['nm_perusahaan'],
            "'" . $row['bpjs_ket'],
            "'" . $row['bpjs_tk'],
            "'" . $row['npwp'],
            $row['vaksin_1'],
            $row['tgl_join'],
        ];
    }
}
