<?php

namespace Tests\Feature;

use App\Support\Alert;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_login_page_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_alert_adapter_flashes_a_safe_sweetalert_payload(): void
    {
        Alert::success('Berhasil', 'Data tersimpan');

        $payload = json_decode(session('alert.config'), true, flags: JSON_THROW_ON_ERROR);

        self::assertSame('success', $payload['icon']);
        self::assertSame('Berhasil', $payload['title']);
        self::assertSame('Data tersimpan', $payload['text']);
    }
}
