<?php

namespace App\Mail;

use App\Models\Aplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $aplication;


    public function __construct(Aplication $aplication)
    {
        $this->aplication = $aplication;
    }


    public function build()
    {
        $mail = $this->from('example@example.com', 'Example')
            ->subject('Application Created')
            ->view('emails.application-created');

        if (! is_null($this->aplication->file_url)){
            $mail->attachFromStorageDisk('public', $this->aplication->file_url);
        }

        return $mail;
    }
}
