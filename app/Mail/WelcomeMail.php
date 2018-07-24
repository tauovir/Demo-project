<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public $data;
    public function __construct(array $data)
    {
     $this->data = $data;  // Assigned data to member variable so it will be avalable in view page
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->from(env('MAIL_FROM'))->subject(trans('apiMessages.welcomeMailSubject'))
         ->view('mail-template.welcome');
    }
}
