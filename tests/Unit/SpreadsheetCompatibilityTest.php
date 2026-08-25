<?php

namespace Tests\Unit;

use OpenSpout\Common\Entity\Row;
use OpenSpout\Reader\XLSX\Reader;
use OpenSpout\Writer\XLSX\Writer;
use PHPUnit\Framework\TestCase;

class SpreadsheetCompatibilityTest extends TestCase
{
    public function test_openspout_can_round_trip_an_xlsx_file(): void
    {
        $filePath = sys_get_temp_dir().DIRECTORY_SEPARATOR.'epayslip-'.bin2hex(random_bytes(8)).'.xlsx';

        try {
            $writer = new Writer();
            $writer->openToFile($filePath);
            $writer->addRow(Row::fromValues(['NIK', 'Nama']));
            $writer->addRow(Row::fromValues(['EMP-001', 'Test Karyawan']));
            $writer->close();

            $rows = [];
            $reader = new Reader();
            $reader->open($filePath);

            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $row) {
                    $rows[] = $row->toArray();
                }

                break;
            }

            $reader->close();

            self::assertSame([
                ['NIK', 'Nama'],
                ['EMP-001', 'Test Karyawan'],
            ], $rows);
        } finally {
            if (is_file($filePath)) {
                unlink($filePath);
            }
        }
    }
}
