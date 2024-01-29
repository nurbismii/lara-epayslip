<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluasiKetenagakerjaan extends Model
{
    use HasFactory;
    protected $fillable = [
        'data_karyawan_id','jml_kehadiran','kategori_kehadiran','nilai_kehadiran','jml_alfa','kategori_alfa','nilai_alfa','jml_sakit','kategori_sakit','nilai_sakit','jml_paidleave','kategori_paidleave','nilai_paidleave','jml_unpaidleave','kategori_unpaidleave','nilai_unpaidleave','jml_keterlambatan','nilai_keterlambatan','kategori_keterlambatan','jml_pulang_cepat','kategori_pulang_cepat','nilai_pulang_cepat','jml_cuti','kategori_cuti','nilai_cuti','jml_off','kategori_off','nilai_off','pelanggaran_dikembalikan_kehrd','pelanggaran_tidak_memiliki_npwp','jml_sp1','nilai_sp1','jml_sp2','nilai_sp2','jml_sp3','nilai_sp3','jml_surat_pernyataan','nilai_surat_pernyataan','jml_denda','nilai_denda','pelanggaran_lainnya','total_nilai','nilai_terkonversi','poin_nilai_kehadiran','poin_nilai_alfa','poin_nilai_sakit','poin_nilai_paidleave','poin_nilai_unpaidleave','poin_nilai_keterlambatan','poin_nilai_pulang_cepat','poin_nilai_cuti','poin_nilai_off'
    ];

    public function data_karyawan()
    {
        return $this->belongsTo(DataKaryawan::class);
    }
}
