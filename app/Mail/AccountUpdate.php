<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $user)
    {
    }
   
    public function build()
    {
        return $this->from(config('app.mail_from_address'), 'E-Barangay System | San Gavino')
                    ->subject('E-Barangay System | San Gavino - Account Status Update')
                    ->markdown('emails.account_update', [
                        'user' => $this->user,
                        'url' => route('login'),

        ]); // with params
    }
}