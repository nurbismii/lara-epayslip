<?php

namespace App\Imports;

use App\Models\EvaluasiKetenagakerjaan;
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
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class EvaluasiKetenagakerjaanImport  implements ToModel, WithHeadingRow, SkipsOnError, withValidation, SkipsOnFailure, WithChunkReading, WithBatchInserts
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

            EvaluasiKetenagakerjaan::create([
                'data_karyawan_id' => $karyawan->id ?? null,
                'jml_kehadiran' => $row['jml_kehadiran'],
                'kategori_kehadiran' => $row['kategori_kehadiran'],
                'nilai_kehadiran' => $row['nilai_kehadiran'],
                'jml_alfa' => $row['jml_alfa'],
                'kategori_alfa' => $row['kategori_alfa'],
                'nilai_alfa' => $row['nilai_alfa'],
                'jml_sakit' => $row['jml_sakit'],
                'kategori_sakit' => $row['kategori_sakit'],
                'nilai_sakit' => $row['nilai_sakit'],
                'jml_paidleave' => $row['jml_paidleave'],
                'kategori_paidleave' => $row['kategori_paidleave'],
                'nilai_paidleave' => $row['nilai_paidleave'],
                'kategori_unpaidleave' => $row['kategori_unpaidleave'],
                'jml_unpaidleave' => $row['jml_unpaidleave'],
                'nilai_unpaidleave' => $row['nilai_unpaidleave'],
                'jml_keterlambatan' => $row['jml_keterlambatan'],
                'kategori_keterlambatan' => $row['kategori_keterlambatan'],
                'nilai_keterlambatan' => $row['nilai_keterlambatan'],
                'jml_pulang_cepat' => $row['jml_pulang_cepat'],
                'kategori_pulang_cepat' => $row['kategori_pulang_cepat'],
                'nilai_pulang_cepat' => $row['nilai_pulang_cepat'],
                'jml_cuti' => $row['jml_cuti'],
                'kategori_cuti' => $row['kategori_cuti'],
                'nilai_cuti' => $row['nilai_cuti'],
                'jml_off' => $row['jml_off'],
                'kategori_off' => $row['kategori_off'],
                'nilai_off' => $row['nilai_off'],
                'pelanggaran_dikembalikan_kehrd' => $row['pelanggaran_dikembalikan_ke_hrd'],
                'pelanggaran_tidak_memiliki_npwp' => $row['pelanggaran_tidak_memiliki_npwp'],
                'jml_sp1' => $row['jml_sp1'],
                'nilai_sp1' => $row['nilai_sp1'],
                'jml_sp2' => $row['jml_sp2'],
                'nilai_sp2' => $row['nilai_sp2'],
                'jml_sp3' => $row['jml_sp3'],
                'nilai_sp3' => $row['nilai_sp3'],
                'jml_surat_pernyataan' => $row['jml_surat_pernyataan'],
                'nilai_surat_pernyataan' => $row['nilai_surat_pernyataan'],
                'jml_denda' => $row['jml_denda'],
                'nilai_denda' => $row['nilai_denda'],
                'pelanggaran_lainnya' => $row['pelanggaran_lainnya'],
                'total_nilai' => $row['total_nilai'],
                'nilai_terkonversi' => $row['nilai_terkonversi'],
                'poin_nilai_kehadiran' => $row['poin_nilai_kehadiran'],
                'poin_nilai_alfa' => $row['poin_nilai_alfa'],
                'poin_nilai_sakit' => $row['poin_nilai_sakit'],
                'poin_nilai_paidleave' => $row['poin_nilai_paidleave'],
                'poin_nilai_unpaidleave' => $row['poin_nilai_unpaidleave'],
                'poin_nilai_keterlambatan' => $row['poin_nilai_keterlambatan'],
                'poin_nilai_pulang_cepat' => $row['poin_nilai_pulang_cepat'],
                'poin_nilai_cuti' => $row['poin_nilai_cuti'],
                'poin_nilai_off' => $row['poin_nilai_off'],
            ]);
        }
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
            '*.nik' => ['required'],
            '*.no_ktp' => ['required'],
        ];
    }
}
