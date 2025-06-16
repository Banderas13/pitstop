<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VraagIngediend extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $vraag;

    public function __construct($email, $vraag)
    {
        $this->email = $email;
        $this->vraag = $vraag;
    }

    public function build()
    {
        return $this->subject('Nieuwe vraag/opmerking ontvangen')
                    ->view('emails.vraag')
                    ->with([
                        'email' => $this->email,
                        'vraag' => $this->vraag,
                    ]);
    }
}

