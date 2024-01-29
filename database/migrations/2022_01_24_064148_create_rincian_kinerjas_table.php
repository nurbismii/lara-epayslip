<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRincianKinerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rincian_kinerjas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_kinerja_id');
            $table->foreign('jenis_kinerja_id')->references('id')->on('jenis_kinerjas')->onDelete('cascade');
            $table->string('rincian_kinerja');
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
        Schema::dropIfExists('rincian_kinerjas');
    }
}
