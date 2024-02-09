<?php

namespace App\Imports;

use App\Models\DataKaryawan;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PerubahanKaryawan implements ToCollection, WithHeadingRow, SkipsOnError, withValidation, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    private $niks;

    public function __construct()
    {
        $this->niks = DataKaryawan::select('id', 'nik', 'no_ktp')->get();
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $collect) {

            $check_exist = DataKaryawan::where('nik', '!=', $collect['nik'])->where('no_ktp', $collect['no_ktp'])->first();

            if ($check_exist) {
                $check_exist->delete();
            }

            DataKaryawan::updateOrCreate(
                [
                    'nik' => $collect['nik'],
                ],
                [
                    'nik' => $collect['nik'],
                    'no_ktp' => $collect['no_ktp'],
                    'nama' => $collect['nama'],
                    'npwp' => $collect['no_npwp'],
                    'tgl_lahir' =>  Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($collect['tanggal_lahir'])),
                    'nm_perusahaan' => $collect['nm_perusahaan'],
                    'bpjs_ket' => $collect['no_bpjs_kes'],
                    'bpjs_tk' => $collect['no_bpjs_tk'],
                    'vaksin_1' => $collect['vaksin'],
                    'tgl_join' =>  Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($collect['tanggal_join'])),
                ]
            );
        }
    }

    public function rules(): array
    {
        return [
            '*.nik' => ['required'],
            '*.no_ktp' => ['required'],
        ];
    }
}
