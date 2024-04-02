<?php

namespace App\Imports;

use App\Models\DataKaryawan;
use App\Models\FailUploadKomponen;
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
use Maatwebsite\Excel\Concerns\RemembersRowNumber;

class HapusKaryawan implements ToCollection, WithHeadingRow, SkipsOnError, withValidation, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures, RemembersRowNumber;

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

            $check_exist = DataKaryawan::where('nik', $collect['nik'])->where('no_ktp', $collect['no_ktp'])->first();

            if (empty($check_exist)) {
                FailUploadKomponen::create([
                    'baris' => $this->getRowNumber(),
                    'nik' => $collect['nik'],
                    'no_ktp' => $collect['no_ktp'],
                ]);
            } else {
                DataKaryawan::where('nik', $collect['nik'])->update([
                    'nik' => $collect['nik'],
                    'no_ktp' => $collect['no_ktp'],
                    'status_karyawan' => $collect['status_karyawan'],
                ]);
            }
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
