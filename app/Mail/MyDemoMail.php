<?php
// MyDemoMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyDemoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;

    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    public function build()
    {
        return $this->to($this->mailData['email'])
                    ->from($this->mailData['from'])
                    ->subject($this->mailData['subject'])
                    ->markdown('emails.my_demo_mail')
                    ->with([
                        'subject' => $this->mailData['subject'],
                        'message' => $this->mailData['message'],
                    ]);
    }
}
