<?php

namespace Tests\Feature;

use App\Models\DataKaryawan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\QueryException;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class HasilEvaluasiMigrationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');
        $this->artisan('migrate', [
            '--path' => 'database/migrations/2021_09_13_033056_create_data_karyawans_table.php',
        ])->assertSuccessful();
    }

    private function migration(): Migration
    {
        require_once database_path('migrations/2022_02_13_054152_create_hasil_evaluasis_table.php');

        return new \CreateHasilEvaluasisTable();
    }

    private function partialTable(bool $withEmployeeColumn = false): void
    {
        Schema::create('hasil_evaluasis', function (Blueprint $table) use ($withEmployeeColumn) {
            $table->id();
            if ($withEmployeeColumn) {
                $table->unsignedBigInteger('data_karyawan_id');
            }
            $table->string('evaluasi_pencapaian_kinerja');
            $table->string('evaluasi_pencapaian-kerja');
            $table->string('evaluasi_patuh_ketenagakerjaan');
            $table->timestamps();
        });
    }

    private function employee(): DataKaryawan
    {
        return DataKaryawan::forceCreate([
            'nik' => 'TEST-001', 'no_ktp' => '0123456789012345', 'nama' => 'Karyawan Uji',
            'departemen' => 'Uji', 'divisi' => 'Uji', 'posisi' => 'Uji', 'tgl_lahir' => '1990-02-03',
        ]);
    }

    private function evaluation(): array
    {
        return [
            'evaluasi_pencapaian_kinerja' => 'Baik',
            'evaluasi_pencapaian-kerja' => 'Baik',
            'evaluasi_patuh_ketenagakerjaan' => 'Baik',
        ];
    }

    public function test_fresh_migration_creates_employee_relation_and_cascades_deletion(): void
    {
        $migration = $this->migration();
        $migration->up();
        $employee = $this->employee();
        DB::table('hasil_evaluasis')->insert($this->evaluation() + ['data_karyawan_id' => $employee->id]);
        $this->assertDatabaseCount('hasil_evaluasis', 1);
        $employee->delete();
        $this->assertDatabaseCount('hasil_evaluasis', 0);
        $migration->down();
        $this->assertFalse(Schema::hasTable('hasil_evaluasis'));
    }

    public function test_retry_repairs_the_empty_table_left_by_mysql_and_does_not_duplicate_foreign_keys(): void
    {
        $this->partialTable();
        $this->migration()->up();
        $this->migration()->up();
        $this->assertTrue(Schema::hasColumn('hasil_evaluasis', 'data_karyawan_id'));
        $keys = Schema::getForeignKeys('hasil_evaluasis');
        $this->assertCount(1, $keys);
        $this->assertSame(['data_karyawan_id'], $keys[0]['columns']);
        $this->assertSame('data_karyawans', $keys[0]['foreign_table']);

        $this->expectException(QueryException::class);
        DB::table('hasil_evaluasis')->insert($this->evaluation() + ['data_karyawan_id' => 999]);
    }

    public function test_retry_preserves_existing_rows_when_the_employee_column_is_already_present(): void
    {
        $this->partialTable(true);
        $employee = $this->employee();
        $row = $this->evaluation() + ['id' => 42, 'data_karyawan_id' => $employee->id];
        DB::table('hasil_evaluasis')->insert($row);
        $this->migration()->up();
        $this->assertDatabaseHas('hasil_evaluasis', $row);
        $this->assertCount(1, Schema::getForeignKeys('hasil_evaluasis'));
    }

    public function test_retry_preserves_unmapped_rows_and_requires_mapping_instead_of_guessing_an_employee(): void
    {
        $this->partialTable();
        $row = $this->evaluation() + ['id' => 42];
        DB::table('hasil_evaluasis')->insert($row);
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Petakan data ke karyawan');

        try {
            $this->migration()->up();
        } finally {
            $this->assertDatabaseHas('hasil_evaluasis', $row);
            $this->assertFalse(Schema::hasColumn('hasil_evaluasis', 'data_karyawan_id'));
        }
    }
}
