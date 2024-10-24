<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $messageContent;
    public $fromEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $messageContent, $fromEmail)
    {
        $this->subject = $subject;
        $this->messageContent = $messageContent;
        $this->fromEmail = $fromEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->fromEmail)
            ->subject($this->subject)
            ->view('notification')
            ->with('messageContent', $this->messageContent);
    }
}