<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordLink extends Mailable
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
      $this->data = $data;  //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
          return $this->from(env('MAIL_FROM'))->subject(trans('apiMessages.resetPasswordSubject'))
         ->view('mail-template.resetPasswordLink');
    }
}
