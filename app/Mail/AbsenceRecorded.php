<?php

namespace App\Mail;

use App\Models\Absence;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AbsenceRecorded extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public Absence $absence
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Absence enregistrée - ' . $this->absence->apprenant->nom_apprenant,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.absence-recorded',
            with: [
                'absence' => $this->absence,
                'apprenant' => $this->absence->apprenant,
                'classe' => $this->absence->apprenant->classe,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
