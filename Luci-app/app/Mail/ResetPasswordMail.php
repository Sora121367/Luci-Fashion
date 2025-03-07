<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reset_code;

    public function __construct($reset_code)
    {
        $this->reset_code = $reset_code;
    }

    public function build()
    {
        return $this->subject('Password Reset Code')
                    ->view('Email.resetpassword')
                    ->with(['reset_code' => $this->reset_code]);
    }
}
