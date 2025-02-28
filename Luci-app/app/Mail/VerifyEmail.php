<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $verification_code;

    public function __construct($verification_code)
    {
        $this->verification_code = $verification_code;
    }

    public function build()
    {
        return $this->subject('Email Verification Code')
                    ->view('Email.sendcode')
                    ->with('verification_code', $this->verification_code);
    }
}
