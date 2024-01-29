<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilEvaluasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_evaluasis', function (Blueprint $table) {
            $table->id();
            $table->foreign('data_karyawan_id')->references('id')->on('data_karyawans')->onDelete('cascade');
            $table->string('evaluasi_pencapaian_kinerja');
            $table->string('evaluasi_pencapaian-kerja');
            $table->string('evaluasi_patuh_ketenagakerjaan');
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
        Schema::dropIfExists('hasil_evaluasis');
    }
}
