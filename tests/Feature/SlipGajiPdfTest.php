<?php

namespace Tests\Feature;

use App\Models\DataKaryawan;
use App\Models\KomponenGaji;
use Tests\TestCase;

class SlipGajiPdfTest extends TestCase
{
    private function slip(string $company): KomponenGaji
    {
        $slip = new KomponenGaji();
        $slip->forceFill([
            'periode' => '2026-01',
            'gaji_pokok' => 8500000,
            'tot_diterima' => 9000000,
            'tunj_fungsional' => 100000,
            'kompensasi' => 200000,
            'deduction_alpa' => 50000,
        ]);
        $slip->setRelation('data_karyawan', new DataKaryawan([
            'nama' => 'Karyawan Uji',
            'nik' => 'TEST-001',
            'nm_perusahaan' => $company,
        ]));

        return $slip;
    }

    public function test_both_company_logos_are_embedded_in_downloadable_a4_pdfs(): void
    {
        foreach (['VDNI', 'VDNIP'] as $company) {
            $html = view('slip_gaji.slip-pdf', ['cek' => $this->slip($company)])->render();
            $this->assertStringContainsString('PT ' . $company, $html);
            $this->assertStringContainsString('data:image/png;base64,', $html);
            $this->assertStringNotContainsString('https://', $html);
            $this->assertStringContainsString('16 Desember 2025', $html);
            foreach (['Tunjangan fungsional', 'Kompensasi', 'Deduction alpa', '9.000.000'] as $text) {
                $this->assertStringContainsString($text, $html);
            }

            $pdf = app('dompdf.wrapper')->loadHTML($html)->setPaper('a4', 'portrait');
            $response = $pdf->download('Slip-Gaji-2026-01.pdf');
            $this->assertSame('application/pdf', $response->headers->get('Content-Type'));
            $this->assertStringContainsString('attachment;', $response->headers->get('Content-Disposition'));
            $this->assertStringStartsWith('%PDF-', $response->getContent());
            $this->assertStringContainsString('/Subtype /Image', $response->getContent());
            $this->assertSame(1, $pdf->getDomPDF()->getCanvas()->get_page_count());
        }
    }

    public function test_custom_dates_and_empty_deductions_are_displayed(): void
    {
        $slip = $this->slip('VDNI');
        $slip->forceFill([
            'mulai_periode' => '2026-01-01',
            'akhir_periode' => '2026-01-31',
            'deduction_alpa' => 0,
        ]);
        $html = view('slip_gaji.slip-pdf', ['cek' => $slip])->render();
        $this->assertStringContainsString('01 Januari 2026 - 31 Januari 2026', $html);
        $this->assertStringContainsString('Tidak ada potongan.', $html);
    }

    public function test_mandarin_font_supports_normal_and_bold_employee_text(): void
    {
        $slip = $this->slip('VDNI');
        $slip->data_karyawan->nama = '张伟 / 陳志明';
        $slip->posisi = '工程师';
        $pdf = app('dompdf.wrapper')->loadView('slip_gaji.slip-pdf', ['cek' => $slip])
            ->setOption('isFontSubsettingEnabled', true);
        $output = $pdf->output();
        $dompdf = $pdf->getDomPDF();

        foreach (['normal', 'bold'] as $weight) {
            $font = $dompdf->getFontMetrics()->getFont('Payslip CJK', $weight);
            $this->assertNotNull($font);
            foreach (preg_split('//u', '张伟陳志明工程师', -1, PREG_SPLIT_NO_EMPTY) as $character) {
                $this->assertTrue($dompdf->getCanvas()->font_supports_char($font, $character));
            }
        }

        $this->assertTrue(strlen($output) < 1000000, 'The PDF should embed only the used font glyphs.');
    }
}
