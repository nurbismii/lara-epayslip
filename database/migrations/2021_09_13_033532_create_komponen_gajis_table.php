<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomponenGajisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komponen_gajis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_karyawan_id');
            $table->foreign('data_karyawan_id')->references('id')->on('data_karyawans')->onDelete('cascade');
            $table->date('durasi_sp')->nullable();
            $table->string('jml_hari_kerja')->nullable();
            $table->string('jml_hour_machine')->nullable();
            $table->string('gaji_pokok')->nullable();
            $table->string('tunj_um')->nullable();
            $table->string('tunj_pengawas')->nullable();
            $table->string('tunj_transport')->nullable();
            $table->string('tunj_mk')->nullable();
            $table->string('tunj_koefisien')->nullable();
            $table->string('ot')->nullable();
            $table->string('hm')->nullable();
            $table->string('rapel')->nullable();
            $table->string('insentif')->nullable();
            $table->string('tunj_lap')->nullable();
            $table->string('jht')->nullable();
            $table->string('jp')->nullable();
            $table->string('pot_bpjskes')->nullable();
            $table->string('unpaid_leave')->nullable();
            $table->string('deduction')->nullable();
            $table->string('tot_diterima')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_number')->nullable();
            $table->string('periode');
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
        Schema::dropIfExists('komponen_gajis');
    }
}
