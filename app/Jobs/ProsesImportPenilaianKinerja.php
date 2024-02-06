<?php

namespace App\Jobs;

use App\Models\DataKaryawan;
use App\Models\FailUploadKomponen;
use App\Models\KomponenGaji;
use App\Models\PenilaianPencapaianKinerja;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ProsesImportPenilaianKinerja implements ShouldQueue
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
                        $rasa_tanggung_jawab = $cells[2];
                        $kedisiplinan = $cells[3];
                        $etika_kerja_dedikasi_kerja = $cells[4];
                        $pengetahuan_profesi = $cells[5];
                        $kemampuan_pengambilan_keputusan = $cells[6];
                        $kemampuan_pemahaman_dalam_bekerja = $cells[7];
                        $pengendalian_diri_dalam_bekerja = $cells[8];
                        $kualitas_kerja = $cells[9];
                        $efisiensi_kerja = $cells[10];
                        $kesadaran_keselamatan = $cells[11];
                        $total_nilai_pencapaian_kinerja = $cells[12];
                        $total_pencapaian_kerja = $cells[13];


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
                                PenilaianPencapaianKinerja::insert([
                                    'data_karyawan_id' => $karyawan->id ?? null,
                                    'rasa_tanggung_jawab' => $rasa_tanggung_jawab,
                                    'kedisiplinan' => $kedisiplinan,
                                    'etika_kerja' => $etika_kerja_dedikasi_kerja,
                                    'pengetahuan_profesi' => $pengetahuan_profesi,
                                    'pengambilan_keputusan' => $kemampuan_pengambilan_keputusan,
                                    'pemahaman_dalam_bekerja' => $kemampuan_pemahaman_dalam_bekerja,
                                    'pengendalian_diri' => $pengendalian_diri_dalam_bekerja,
                                    'kualitas_kerja' => $kualitas_kerja,
                                    'efesiensi_kerja' => $efisiensi_kerja,
                                    'keselamatan_dalam_kerja' => $kesadaran_keselamatan,
                                    'total_nilai_kinerja' => $total_nilai_pencapaian_kinerja,
                                    'total_nilai_pencapaian' => $total_pencapaian_kerja,
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
