<?php

namespace App\Jobs;

use App\Models\DataKaryawan;
use App\Models\FailUploadKomponen;
use App\Models\KomponenGaji;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Carbon;

class ProsesImportSalary implements ShouldQueue
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
                        $no_ktp = str_replace(array('\'', '"'), '' ,$cells[1]);
                        $departemen = $cells[2];
                        $divisi = $cells[3];
                        $posisi = $cells[4];
                        $status = $cells[5];
                        $durasi_sp = $cells[6];
                        $jml_hari_kerja = $cells[7];
                        $jml_hour_machine = $cells[8];
                        $gapok = $cells[9];
                        $tunj_um = $cells[10];
                        $tunj_pegawai = $cells[11];
                        $tunj_transport = $cells[12];
                        $tunj_masa_kerja = $cells[13];
                        $tunj_koefisien = $cells[14];
                        $overtime = $cells[15];
                        $hour_machine = $cells[16];

                        $bpjs_tk_jht = $cells[17];
                        $bpjs_tk_jp = $cells[18];
                        $bpjs_kes = $cells[19];

                        // add new fields 
                        $tunj_fungsional = $cells[20];
                        //----
                        $tunj_lapangan = $cells[21];

                        $bonus = $cells[22];
                        $insentif = $cells[23];
                        $rapel = $cells[24];
                        $kompensasi = $cells[25];
                        
                        $deduction_unpaid_leave = $cells[26];
                        // add new fields
                        $deduction_alpa = $cells[27];
                        //----
                        $deduction = $cells[28];
                        $deduction_pph21 = $cells[29];

                        $tot_diterima = $cells[30];
                        $bank_number = $cells[31];
                        $bank_name = $cells[32];
                        $periode = $cells[33];
                        $thr = $cells[34];
                        $mulai_periode = $cells[35];
                        $akhir_periode = $cells[36];
                        $tanggal_gajian = $cells[37];


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
                                KomponenGaji::insert([
                                    'data_karyawan_id' => $karyawan->id ?? null,
                                    'departemen' => $departemen,
                                    'divisi' => $divisi,
                                    'posisi' => $posisi,
                                    'durasi_sp' => $durasi_sp,
                                    'status_gaji' => $status,
                                    'jml_hari_kerja' => $jml_hari_kerja,
                                    'jml_hour_machine' => $jml_hour_machine,
                                    'gaji_pokok' => $gapok,
                                    'tunj_um' => $tunj_um,
                                    'tunj_pengawas' => $tunj_pegawai,
                                    'tunj_transport' => $tunj_transport,
                                    'tunj_mk' => $tunj_masa_kerja,
                                    'tunj_koefisien' => $tunj_koefisien,
                                    'ot' => $overtime,
                                    'hm' => $hour_machine,
                                    'rapel' => $rapel,
                                    'insentif' => $insentif,
                                    'kompensasi' => $kompensasi,
                                    'tunj_lap' => $tunj_lapangan,
                                    'tunj_fungsional' => $tunj_fungsional,
                                    'bonus' => $bonus,
                                    'jht' => $bpjs_tk_jht,
                                    'jp' => $bpjs_tk_jp,
                                    'pot_bpjskes' => $bpjs_kes,
                                    'unpaid_leave' => $deduction_unpaid_leave,
                                    'deduction' => $deduction,
                                    'tot_diterima' => $tot_diterima,
                                    'bank_name' => $bank_name,
                                    'bank_number' => $bank_number,
                                    'periode' => $periode,
                                    'deduction_pph21' => $deduction_pph21,
                                    'deduction_alpa' => $deduction_alpa,
                                    'thr' => $thr,
                                    'mulai_periode' => $mulai_periode,
                                    'akhir_periode' => $akhir_periode,
                                    'tanggal_gajian' => $tanggal_gajian,
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
