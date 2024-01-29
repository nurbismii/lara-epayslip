<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNPWPBPJS extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_karyawans', function (Blueprint $table) {
            $table->string('npwp')->nullable();
            $table->string('bpjs_ket')->nullable();
            $table->string('bpjs_tk')->nullable();
            $table->string('vaksin_1')->nullable();
            $table->string('vaksin_2')->nullable();
            $table->string('tgl_join')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_karyawans', function (Blueprint $table) {
            //
        });
    }
}
