<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluasiKetenagakerjaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluasi_ketenagakerjaans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_karyawan_id');
            $table->foreign('data_karyawan_id')->references('id')->on('data_karyawans')->onDelete('cascade');
            $table->string('jml_kehadiran')->nullable();
            $table->string('kategori_kehadiran')->nullable();
            $table->string('nilai_kehadiran')->nullable();
            $table->string('jml_alfa')->nullable();
            $table->string('kategori_alfa')->nullable();
            $table->string('nilai_alfa')->nullable();
            $table->string('jml_sakit')->nullable();
            $table->string('kategori_sakit')->nullable();
            $table->string('nilai_sakit')->nullable();
            $table->string('jml_paidleave')->nullable();
            $table->string('kategori_paidleave')->nullable();
            $table->string('nilai_paidleave')->nullable();
            $table->string('jml_unpaidleave')->nullable();
            $table->string('kategori_unpaidleave')->nullable();
            $table->string('nilai_unpaidleave')->nullable();
            $table->string('jml_keterlambatan')->nullable();
            $table->string('kategori_keterlambatan')->nullable();
            $table->string('nilai_keterlambatan')->nullable();
            $table->string('jml_pulang_cepat')->nullable();
            $table->string('kategori_pulang_cepat')->nullable();
            $table->string('nilai_pulang_cepat')->nullable();
            $table->string('jml_cuti')->nullable();
            $table->string('kategori_cuti')->nullable();
            $table->string('nilai_cuti')->nullable();
            $table->string('jml_off')->nullable();
            $table->string('kategori_off')->nullable();
            $table->string('nilai_off')->nullable();
            $table->string('pelanggaran_dikembalikan_kehrd')->nullable();
            $table->string('pelanggaran_tidak_memiliki_npwp')->nullable();
            $table->string('jml_sp1')->nullable();
            $table->string('nilai_sp1')->nullable();
            $table->string('jml_sp2')->nullable();
            $table->string('nilai_sp2')->nullable();
            $table->string('jml_sp3')->nullable();
            $table->string('nilai_sp3')->nullable();
            $table->string('jml_surat_pernyataan')->nullable();
            $table->string('nilai_surat_pernyataan')->nullable();
            $table->string('jml_denda')->nullable();
            $table->string('nilai_denda')->nullable();
            $table->string('pelanggaran_lainnya')->nullable();
            $table->string('total_nilai')->nullable();
            $table->string('nilai_terkonversi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluasi_ketenagakerjaans');
    }
}
