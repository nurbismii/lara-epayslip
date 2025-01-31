<?php

namespace App\Imports;

use App\Models\PenilaianPencapaianKinerja;
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

class PenilaianKinerja implements ToModel, WithHeadingRow, SkipsOnError, withValidation, SkipsOnFailure, WithChunkReading, WithBatchInserts
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

            return new PenilaianPencapaianKinerja([
                'data_karyawan_id' => $karyawan->id ?? null,
                'rasa_tanggung_jawab' => $row['rasa_tanggung_jawab'],
                'etika_kerja' => $row['etika_kerja_dedikasi_kerja'],
                'kedisiplinan' => $row['kedisiplinan'],
                'pengetahuan_profesi' => $row['pengetahuan_profesi'],
                'pemahaman_dalam_bekerja' => $row['kemampuan_pemahaman_dalam_bekerja'],
                'pengambilan_keputusan' => $row['kemampuan_pengambilan_keputusan'],
                'efesiensi_kerja' => $row['efisiensi_kerja'],
                'pengendalian_diri' => $row['pengendalian_diri_dalam_bekerja'],
                'kualitas_kerja' => $row['kualitas_kerja'],
                'keselamatan_dalam_kerja' => $row['kesadaran_keselamatan_dalam_bekerja'],
                'total_nilai_kinerja' => $row['total_nilai_pencapaian_kinerja'],
                // 'pencapaian_kerja' => $row['pencapaian_kerja'],
                // 'sangat_baik' => $row['sangat_baik'],
                // 'baik' => $row['baik'],
                // 'cukup' => $row['cukup'],
                // 'kurang' => $row['kurang'],
                'total_nilai_pencapaian' => $row['total_nilai_pencapaian_kerja'],
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
