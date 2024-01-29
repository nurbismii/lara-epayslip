<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePencapaianKinerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pencapaian_kinerjas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rincian_kinerja_id');
            $table->foreign('rincian_kinerja_id')->references('id')->on('rincian_kinerjas')->onDelete('cascade');
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
        Schema::dropIfExists('pencapaian_kinerjas');
    }
}
