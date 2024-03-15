<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendRequestUpdate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public $request)
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
                    ->markdown('emails.send_request_update', [
                        'request' => $this->request,
                        'url' => route('resident.requests.index'),

            ]); // with params
    }
}