<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class KMRC_Message extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public $data;
    public $name;
    public $subject;
    public $msg;

    public function __construct($name,$subject,$msg)
    {
        // $this->data = $data;
        $this->name = $name;
        $this->subject = $subject;
        $this->msg= $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //  dd($messageVerif);
        return $this->markdown('emails.project-kmrcmessage');
    }
}
