<?php

namespace App\Jobs;

use App\Models\DataKaryawan;
use App\Models\EvaluasiKetenagakerjaan;
use App\Models\FailUploadKomponen;
use App\Models\KomponenGaji;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ProsesImportEvaluasiKetenagakerjaan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file)
    {
        //
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $filePath = storage_path('app/' . $this->file);

        $reader = ReaderEntityFactory::createXLSXReader();
        // panggil class XLSXReader
        $reader->open($filePath);
        // buka filenya

        foreach ($reader->getSheetIterator() as $sheet) {
            // perulangan untuk membaca sheet yang ada di file
            if ($sheet->getIndex() === 0) {
                // hanya membaca sheet pertama (index = 0)
                $no = 0;
                // init variabel nomor
                // digunakan untuk mendeteksi baris keberapa
                // dimulai dari 0
                foreach ($sheet->getRowIterator() as $row) {
                    // perulangan membaca baris excel
                    if ($no > 0) {
                        // skip baris pertama (0), karena berisi header kolom
                        $cells = $row->toArray();
                        // konversi isi baris menjadi array
                        // untuk isi kolom pertama diambil dengan $cells[0]
                        // untuk kolom kedua $cells[1], dst.
                        $nik = $cells[0];
                        $no_ktp = $cells[1];
                        $jml_kehadiran = $cells[2];
                        $poin_nilai_kehadiran = $cells[3];
                        $kategori_kehadiran = $cells[4];
                        $nilai_kehadiran = $cells[5];
                        $jml_alfa = $cells[6];
                        $poin_nilai_alfa = $cells[7];
                        $kategori_alfa = $cells[8];
                        $nilai_alfa = $cells[9];
                        $jml_sakit = $cells[10];
                        $poin_nilai_sakit = $cells[11];
                        $kategori_sakit = $cells[12];
                        $nilai_sakit = $cells[13];
                        $jml_paidleave = $cells[14];
                        $poin_nilai_paidleave = $cells[15];
                        $kategori_paidleave = $cells[16];
                        $nilai_paidleave = $cells[17];
                        $jml_unpaidleave = $cells[18];
                        $poin_nilai_unpaidleave = $cells[19];
                        $kategori_unpaidleave = $cells[20];
                        $nilai_unpaidleave = $cells[21];
                        $jml_keterlambatan = $cells[22];
                        $poin_nilai_keterlambatan = $cells[23];
                        $kategori_keterlambatan = $cells[24];
                        $nilai_keterlambatan = $cells[25];
                        $jml_pulang_cepat = $cells[26];
                        $poin_nilai_pulang_cepat = $cells[27];
                        $kategori_pulang_cepat = $cells[28];
                        $nilai_pulang_cepat = $cells[29];
                        $jml_cuti = $cells[30];
                        $poin_nilai_cuti = $cells[31];
                        $kategori_cuti = $cells[32];
                        $nilai_cuti = $cells[33];
                        $jml_off = $cells[34];
                        $poin_nilai_off = $cells[35];
                        $kategori_off = $cells[36];
                        $nilai_off = $cells[37];
                        $pelanggaran_dikembalikan_kehrd = $cells[38];
                        $pelanggaran_tidak_memiliki_npwp = $cells[39];
                        $jml_sp1 = $cells[40];
                        $nilai_sp1 = $cells[41];
                        $jml_sp2 = $cells[42];
                        $nilai_sp2 = $cells[43];
                        $jml_sp3 = $cells[44];
                        $nilai_sp3 = $cells[45];
                        $jml_surat_pernyataan = $cells[46];
                        $nilai_surat_pernyataan = $cells[47];
                        $jml_denda = $cells[48];
                        $nilai_denda = $cells[49];
                        $pelanggaran_lainnya = $cells[50];
                        $total_nilai = $cells[51];
                        $nilai_terkonvensi = $cells[52];

                        if (!empty($nik) && !empty($no_ktp)) {

                            $karyawan = DataKaryawan::where('nik', $nik)->where('no_ktp', $no_ktp)->first();

                            if (empty($karyawan)) {
                                // jika nip tidak ada maka insert ke tabel pegawai
                                FailUploadKomponen::insert([
                                    'baris' => $no,
                                    'nik' => $nik,
                                    'no_ktp' => $no_ktp,
                                ]);
                            } else {
                                EvaluasiKetenagakerjaan::insert([
                                    'data_karyawan_id' => $karyawan->id ?? null,
                                    'jml_kehadiran' => $jml_kehadiran,
                                    'kategori_kehadiran' => $kategori_kehadiran,
                                    'nilai_kehadiran' => $nilai_kehadiran,
                                    'jml_alfa' => $jml_alfa,
                                    'kategori_alfa' => $kategori_alfa,
                                    'nilai_alfa' => $nilai_alfa,
                                    'jml_sakit' => $jml_sakit,
                                    'kategori_sakit' => $kategori_sakit,
                                    'nilai_sakit' => $nilai_sakit,
                                    'jml_paidleave' => $jml_paidleave,
                                    'kategori_paidleave' => $kategori_paidleave,
                                    'nilai_paidleave' => $nilai_paidleave,
                                    'kategori_unpaidleave' => $kategori_unpaidleave,
                                    'jml_unpaidleave' => $jml_unpaidleave,
                                    'nilai_unpaidleave' => $nilai_unpaidleave,
                                    'jml_keterlambatan' => $jml_keterlambatan,
                                    'kategori_keterlambatan' => $kategori_keterlambatan,
                                    'nilai_keterlambatan' => $nilai_keterlambatan,
                                    'jml_pulang_cepat' => $jml_pulang_cepat,
                                    'kategori_pulang_cepat' => $kategori_pulang_cepat,
                                    'nilai_pulang_cepat' => $nilai_pulang_cepat,
                                    'jml_cuti' => $jml_cuti,
                                    'kategori_cuti' => $kategori_cuti,
                                    'nilai_cuti' => $nilai_cuti,
                                    'jml_off' => $jml_off,
                                    'kategori_off' => $kategori_off,
                                    'nilai_off' => $nilai_off,
                                    'pelanggaran_dikembalikan_kehrd' => $pelanggaran_dikembalikan_kehrd,
                                    'pelanggaran_tidak_memiliki_npwp' => $pelanggaran_tidak_memiliki_npwp,
                                    'jml_sp1' => $jml_sp1,
                                    'nilai_sp1' => $nilai_sp1,
                                    'jml_sp2' => $jml_sp2,
                                    'nilai_sp2' => $nilai_sp2,
                                    'jml_sp3' => $jml_sp3,
                                    'nilai_sp3' => $nilai_sp3,
                                    'jml_surat_pernyataan' => $jml_surat_pernyataan,
                                    'nilai_surat_pernyataan' => $nilai_surat_pernyataan,
                                    'jml_denda' => $jml_denda,
                                    'nilai_denda' => $nilai_denda,
                                    'pelanggaran_lainnya' => $pelanggaran_lainnya,
                                    'total_nilai' => $total_nilai,
                                    'nilai_terkonversi' => $nilai_terkonvensi,
                                    'poin_nilai_kehadiran' => $poin_nilai_kehadiran,
                                    'poin_nilai_alfa' => $poin_nilai_alfa,
                                    'poin_nilai_sakit' => $poin_nilai_sakit,
                                    'poin_nilai_paidleave' => $poin_nilai_paidleave,
                                    'poin_nilai_unpaidleave' => $poin_nilai_unpaidleave,
                                    'poin_nilai_keterlambatan' => $poin_nilai_keterlambatan,
                                    'poin_nilai_pulang_cepat' => $poin_nilai_pulang_cepat,
                                    'poin_nilai_cuti' => $poin_nilai_cuti,
                                    'poin_nilai_off' => $poin_nilai_off,
                                ]);
                            }
                        }
                    }
                    $no++;
                }
                break;
                // tambahkan break, agar program tidak membaca 
                // sheet selanjutnya
            }
        }
        $reader->close();
        // menutup Excelreader

        Storage::delete($this->file);
        // hapus file yang barusan diimport
    }
}
