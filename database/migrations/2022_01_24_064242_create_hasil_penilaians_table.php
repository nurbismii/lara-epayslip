<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilPenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_penilaians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_karyawan_id');
            $table->foreign('data_karyawan_id')->references('id')->on('data_karyawans')->onDelete('cascade');
            $table->unsignedBigInteger('rincian_kinerja_id');
            $table->foreign('rincian_kinerja_id')->references('id')->on('rincian_kinerjas')->onDelete('cascade');
            $table->unsignedBigInteger('pencapaian_kinerja_id');
            $table->foreign('pencapaian_kinerja_id')->references('id')->on('pencapaian_kinerjas')->onDelete('cascade');
            $table->string('nilai');
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
        Schema::dropIfExists('hasil_penilaians');
    }
}
