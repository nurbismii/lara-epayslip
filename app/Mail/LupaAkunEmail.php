<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LupaAkunEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $url)
    {
    }

    public function build()
    {
        return $this->subject('Verifikasi Pemulihan Akun E-PaySlip')
            ->view('email.lupa_akun');
    }
}
