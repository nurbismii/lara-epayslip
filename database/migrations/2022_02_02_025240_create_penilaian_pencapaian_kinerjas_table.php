<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianPencapaianKinerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_pencapaian_kinerjas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_karyawan_id');
            $table->foreign('data_karyawan_id')->references('id')->on('data_karyawans')->onDelete('cascade');
            $table->string('rasa_tanggung_jawab');
            $table->string('kedisiplinan');
            $table->string('etika_kerja');
            $table->string('pengetahuan_profesi');
            $table->string('pengambilan_keputusan');
            $table->string('pemahaman_dalam_bekerja');
            $table->string('pengendalian_diri');
            $table->string('kualitas_kerja');
            $table->string('efesiensi_kerja');
            $table->string('keselamatan_dalam_kerja');
            $table->string('total_nilai_kinerja');
            $table->string('sangat_baik')->nullable();
            $table->string('baik')->nullable();
            $table->string('cukup')->nullable();
            $table->string('kurang')->nullable();
            $table->string('total_nilai_pencapaian')->nullable();
            $table->string('total_nilai')->nullabel();
            $table->string('kategori')->nullable();
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
        Schema::dropIfExists('penilaian_pencapaian_kinerjas');
    }
}
