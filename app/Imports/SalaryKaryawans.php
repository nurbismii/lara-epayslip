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
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class SalaryKaryawans implements ToModel, WithHeadingRow, SkipsOnError, withValidation, SkipsOnFailure, WithChunkReading, WithBatchInserts
{
    use Importable, SkipsErrors, SkipsFailures;

    private $niks;
    private $row = 2;

    public function __construct()
    {
        $this->niks = DataKaryawan::select('id', 'nik', 'no_ktp')->get();
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $karyawan = $this->niks->where('nik', $row['nik'])->where('no_ktp', $row['no_ktp'])->first();
        if ($karyawan === null) {
            FailUploadKomponen::create([
                'baris' => $this->row,
                'nik' => $row['nik'],
                'no_ktp' => $row['no_ktp'],
            ]);
        } else {
            return new KomponenGaji([
                'data_karyawan_id' => $karyawan->id ?? null,
                'departemen' => $row['departemen'],
                'divisi' => $row['divisi'],
                'posisi' => $row['posisi'],
                'durasi_sp' => Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['durasi_sp'])),
                'status_gaji' => $row['status'],
                'jml_hari_kerja' => $row['jml_hari_kerja'],
                'jml_hour_machine' => $row['jml_hour_machine'],
                'gaji_pokok' => $row['gapok'],
                'tunj_um' => $row['tunj_um'],
                'tunj_pengawas' => $row['tunj_pegawai'],
                'tunj_transport' => $row['tunj_transport_pulsa'],
                'tunj_mk' => $row['tunj_masa_kerja'],
                'tunj_koefisien' => $row['tunj_koefisien_jabatan'],
                'ot' => $row['overtime'],
                'hm' => $row['hour_machine'],
                'rapel' => $row['rapel'],
                'insentif' => $row['insentif'],
                'tunj_lap' => $row['tunj_lapangan'],
                'bonus' => $row['bonus'],
                'jht' => $row['bpjs_tk_jht'],
                'jp' => $row['bpjs_tk_jp'],
                'pot_bpjskes' => $row['bpjs_kes'],
                'unpaid_leave' => $row['deduction_unpaid_leave'],
                'deduction' => $row['deduction'],
                'tot_diterima' => $row['tot_diterima'],
                'bank_name' => $row['bank_name'],
                'bank_number' => $row['bank_number'],
                'periode' => $row['periode'],
                'deduction_pph21' => $row['deduction_pph21'],
                'thr' => $row['thr'],
                'mulai_periode' => Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['mulai_periode'])),
                'akhir_periode' => Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['akhir_periode'])),
                'tanggal_gajian' => Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_gajian'])),
            ]);
        }
        $this->row++;
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
            '*.periode' => ['required'],
        ];
    }
}
