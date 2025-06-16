<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\CaseModel;

class CaseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $case;

    /**
     * Create a new message instance.
     */
    public function __construct(CaseModel $case)
    {
        $this->case = $case;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Nieuwe Case Aangemaakt - ' . $this->case->car->license_plate)
                    ->view('emails.case');
    }
} 