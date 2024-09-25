<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $input = [
            'nama' => $this->data['nama'],
            'token' => $this->data['token']
        ];
        return $this->from('no-reply@vdni.top')
                    ->subject('Konfirmasi Email')
                    ->view('email.index')
                    ->with([
                            'inputs' => $input
                        ]);
    }
}
