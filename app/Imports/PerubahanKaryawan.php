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
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Carbon\Carbon;

class PerubahanKaryawan implements ToCollection, WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures, RemembersRowNumber;

    private $existing;

    public function __construct()
    {
        // Load seluruh data hanya sekali
        $this->existing = DataKaryawan::get()->keyBy('nik');
    }

    public function collection(Collection $rows)
    {
        $upserts = [];
        $newEmployees = [];
        $failUploads = [];

        foreach ($rows as $row) {

            $nik      = $row['nik'];
            $no_ktp   = $row['no_ktp'];
            $found    = $this->existing->get($nik);

            // Jika ketemu: cek kasus NIK berubah tapi KTP sama
            if ($found) {

                if ($found->nik != $nik && $found->no_ktp == $no_ktp) {

                    // Mark ex-karyawan
                    $found->status_karyawan = 'EX KARYAWAN';
                    $found->save();

                    // Simpan ke tabel fail upload
                    $failUploads[] = [
                        'baris' => $this->getRowNumber(),
                        'nik'   => $found->nik,
                        'no_ktp' => $found->no_ktp,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    // Tambah karyawan baru
                    $newEmployees[] = $this->mapRow($row);
                } else {
                    // Upsert karyawan lama
                    $upserts[] = $this->mapRow($row);
                }
            } else {

                // Tidak ada sebelumnya, buat baru (upsert)
                $upserts[] = $this->mapRow($row);
            }
        }

        // Batch upsert – sangat cepat untuk 5k–50k row
        if (!empty($upserts)) {
            DataKaryawan::upsert($upserts, ['nik'], [
                'no_ktp',
                'nama',
                'npwp',
                'tgl_lahir',
                'nm_perusahaan',
                'bpjs_ket',
                'bpjs_tk',
                'vaksin_1',
                'tgl_join'
            ]);
        }

        if (!empty($newEmployees)) {
            DataKaryawan::insert($newEmployees);
        }

        if (!empty($failUploads)) {
            FailUploadKomponen::insert($failUploads);
        }
    }

    private function mapRow($r)
    {
        return [
            'nik' => $r['nik'],
            'no_ktp' => $r['no_ktp'],
            'nama' => $r['nama'],
            'npwp' => str_replace(['.', '-', ','], '', $r['no_npwp']),
            'tgl_lahir' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($r['tanggal_lahir'])),
            'nm_perusahaan' => $r['nm_perusahaan'],
            'bpjs_ket' => $r['no_bpjs_kes'],
            'bpjs_tk' => $r['no_bpjs_tk'],
            'vaksin_1' => $r['vaksin'],
            'tgl_join' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($r['tanggal_join'])),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function rules(): array
    {
        return [
            '*.nik' => ['required'],
            '*.no_ktp' => ['required'],
        ];
    }
}
