<?php

namespace App\Jobs;

use App\Mail\ResetPasswordMail;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $code;
    protected $type;

    public function __construct(User $user, $code, $type = "verify")
    {
       $this->user = $user;
        $this->code = $code;
        $this->type = $type;
    }

    public function handle(): void
    {
        if ($this->type == "verify") {
            Mail::to($this->user->email)->send(new VerifyEmail($this->code));
        }else if($this->type == "reset") {
            Mail::to($this->user->email)->send(new ResetPasswordMail($this->code));
        }
    }
}
