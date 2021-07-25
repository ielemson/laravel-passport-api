<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public  $token;
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    
    public function build()
    {
        $address = 'admin@maxincome.org';
        $subject = 'Password Recovery';
        $name = 'Maxincome Investment Ltd.';
        return $this->view('mail.forgot')
        ->from($address, $name)
        ->subject($subject)
        ->with(['token' => $this->token]);
    }
}
