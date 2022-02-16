<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewMail extends Mailable
{
    use Queueable, SerializesModels;


    public $new_contact;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($new_contact)
    {
        $this->new_contact = $new_contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.new-mail');
    }
}
