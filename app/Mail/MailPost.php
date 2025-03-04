<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailPost extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $msg;
    public $qrcodePath;

    public function __construct($msg, $subject, $qrcodePath)
    {
        $this->subject = $subject;
        $this->msg = $msg;
        $this->qrcodePath = $qrcodePath;  // Path ke gambar QR Code
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            \Illuminate\Mail\Mailables\Attachment::fromPath($this->qrcodePath)
                ->as('qrcode.png')  // Nama file yang akan didownload
                ->withMime('image/png'),  // MIME type untuk gambar
        ];
    }
}
