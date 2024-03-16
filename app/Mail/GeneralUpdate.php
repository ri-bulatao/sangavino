<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GeneralUpdate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public $user, public $message)
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('app.mail_from_address'), 'E-Barangay System | San Gavino')
                    ->subject('E-Barangay System | San Gavino - Services Request Update')
                    ->markdown('emails.general_update', [
                        'user' => $this->user,
                        'message_body' => $this->message,
                        'url' => route('resident.requests.index'),

            ]); // with params
    }
}