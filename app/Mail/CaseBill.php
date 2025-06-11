<?php

namespace App\Mail;

use App\Models\CaseModel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CaseBill extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public CaseModel $case
    ) {
        Log::info('Preparing to send bill email', [
            'case_id' => $this->case->id,
            'customer_email' => $this->case->user->email,
            'price' => $this->case->offer?->price
        ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bill for Your Case' . $this->case->id,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.case-bill',
            with: [
                'case' => $this->case,
                'customer' => $this->case->user,
                'mechanic' => $this->case->mechanic,
                'car' => $this->case->car,
                'offer' => $this->case->offer,
            ],
        );
    }
} 