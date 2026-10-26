<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        if (!Schema::hasTable('hasil_evaluasis')) {
            Schema::create('hasil_evaluasis', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('data_karyawan_id');
                $table->foreign('data_karyawan_id')->references('id')->on('data_karyawans')->onDelete('cascade');
                $table->string('evaluasi_pencapaian_kinerja');
                $table->string('evaluasi_pencapaian-kerja');
                $table->string('evaluasi_patuh_ketenagakerjaan');
                $table->timestamps();
            });
            return;
        }

        // MySQL dapat menyisakan tabel ketika penambahan foreign key gagal.
        if (!Schema::hasColumn('hasil_evaluasis', 'data_karyawan_id')) {
            if (DB::table('hasil_evaluasis')->exists()) {
                throw new RuntimeException('Tabel hasil_evaluasis berisi data tanpa data_karyawan_id. Petakan data ke karyawan sebelum melanjutkan migrasi.');
            }
            Schema::table('hasil_evaluasis', function (Blueprint $table) {
                $table->unsignedBigInteger('data_karyawan_id');
            });
        }

        $hasForeignKey = collect(Schema::getForeignKeys('hasil_evaluasis'))->contains(fn (array $key) =>
            $key['columns'] === ['data_karyawan_id']
            && $key['foreign_table'] === 'data_karyawans'
            && $key['foreign_columns'] === ['id']
        );
        if (!$hasForeignKey) {
            Schema::table('hasil_evaluasis', function (Blueprint $table) {
                $table->foreign('data_karyawan_id')->references('id')->on('data_karyawans')->onDelete('cascade');
            });
        }
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
