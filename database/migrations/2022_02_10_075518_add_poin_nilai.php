<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPoinNilai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evaluasi_ketenagakerjaans', function (Blueprint $table) {
            $table->string('poin_nilai_kehadiran')->nullable();
            $table->string('poin_nilai_alfa')->nullable();
            $table->string('poin_nilai_sakit')->nullable();
            $table->string('poin_nilai_paidleave')->nullable();
            $table->string('poin_nilai_unpaidleave')->nullable();
            $table->string('poin_nilai_keterlambatan')->nullable();
            $table->string('poin_nilai_pulang_cepat')->nullable();
            $table->string('poin_nilai_cuti')->nullable();
            $table->string('poin_nilai_off')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evaluasi_ketenagakerjaans', function (Blueprint $table) {
            //
        });
    }
}
