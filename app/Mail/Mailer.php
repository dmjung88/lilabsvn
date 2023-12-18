<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class Mailer extends Mailable
{
    use Queueable, SerializesModels;

    /** 
     *
     * 
     */

    public $mailData ;

    public function __construct($mailData) {
        $this->mailData = $mailData;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'TITLE',
        );
    }

    /**
     * 보낼 view 템플릿경로
     */
    public function content()
    {
        return new Content(
            view: 'emails.emailView',
        );
    }

    /**
     * 첨부는이곳
     */
    public function attachments()
    {
        return [
            Attachment::fromData(fn() =>$this->mailData['pdf']->output(),'output.pdf')
            ->withMime('application/pdf'),
        ];
    }
}
