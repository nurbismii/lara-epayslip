<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepartemenPosisiPosisi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('komponen_gajis', function (Blueprint $table) {
            $table->string('departemen')->nullable();
            $table->string('divisi')->nullable();
            $table->string('posisi')->nullable();
            $table->string('status_gaji')->nullable();
            $table->string('thr')->nullable();
            $table->string('bonus')->nullable();
            $table->string('deduction_pph21')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('komponen_gajis', function (Blueprint $table) {
            //
        });
    }
}
