<?php

namespace App\Mail;

use App\Models\Bulletin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BulletinGenerated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public Bulletin $bulletin
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Votre bulletin scolaire est prêt - {$this->bulletin->apprenant->nom_apprenant}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.bulletin-generated',
            with: [
                'bulletin' => $this->bulletin,
                'apprenant' => $this->bulletin->apprenant,
                'classe' => $this->bulletin->apprenant->classe,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
