<?php

namespace App\Mail;

use App\Models\Campaign;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PhishingEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Campaign $campaign, public string $recipient)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->campaign->subject,
        );
    }

    public function content(): Content
    {
        $phishingLink = $this->campaign->phishing_link;
        if (strpos($phishingLink, '?') === false) {
            $phishingLink .= '?campaign_id=' . $this->campaign->id;
        } else {
            $phishingLink .= '&campaign_id=' . $this->campaign->id;
        }

        return new Content(
            view: 'emails.phishing',
            with: [
                'campaign' => $this->campaign,
                'phishingLink' => $phishingLink,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
