<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Verification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public $name;
    public $subject;
    public $message;

    public function __construct($data)
    {
        $this->data = $data;
        // $this->name = $name;
        // $this->subjectVerif = $subjectVerif;
        // $this->messageVerif = $messageVerif;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //  dd($messageVerif);
        return $this->markdown('emails.project-createdOne');
    }
}
