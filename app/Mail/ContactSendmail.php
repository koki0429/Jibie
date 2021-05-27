<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactSendmail extends Mailable
{
    use Queueable, SerializesModels;

    private $email;
    private $title;
    private $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inputs)
    {
        $this->email = $inputs['email'];
        $this->title = $inputs['title'];
        $this->content = $inputs['content'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('japanesebrothers@gmail.com')
            ->subject('自動送信メール')
            ->view('contact.mail')
            ->with([
                'email' => $this->email,
                'title' => $this->title,
                'content' => $this->content,
            ]);
    }
}
