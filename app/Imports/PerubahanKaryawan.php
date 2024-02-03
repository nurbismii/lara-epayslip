<?php

namespace App\Imports;
use App\Models\DataKaryawan;
use App\Models\KomponenGaji;
use App\Models\FailUploadKomponen;
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


class PerubahanKaryawan implements ToModel, WithHeadingRow, SkipsOnError, withValidation, SkipsOnFailure
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
            $karyawan->nik = $row['nik'];
            $karyawan->no_ktp = $row['no_ktp'];
            $karyawan->nama = $row['nama'];
            $karyawan->npwp = $row['no_npwp'];
            $karyawan->tgl_lahir = Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_lahir']));
            $karyawan->nm_perusahaan = $row['nm_perusahaan'];
            $karyawan->bpjs_ket = $row['no_bpjs_kes'];
            $karyawan->bpjs_tk = $row['no_bpjs_tk'];
            $karyawan->vaksin_1 = $row['vaksin'];
            $karyawan->tgl_join =  Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_join']));
            $karyawan->update();
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
