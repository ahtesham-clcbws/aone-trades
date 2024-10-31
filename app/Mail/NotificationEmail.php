<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificationEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $mailData;

    /**
     * Create a new message instance.
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notification Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = $this->mailData->to;
        $subject = $this->mailData->subject;
        $name = $this->mailData->name;
        $cc = $this->mailData->cc;
        $bcc = $this->mailData->bcc;
        $from = $this->mailData->from;
        return $this->view('email.laraemail')
            ->text('email.laraemail_plain')
            ->from($from, $name)
            ->cc($address, $name)
            ->bcc($cc, $name)
            ->replyTo($from, $name)
            ->subject($subject)
            ->with(['mailMessage' => $this->mailData]);;
    }
}
