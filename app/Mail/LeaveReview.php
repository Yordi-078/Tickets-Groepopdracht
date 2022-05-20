<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeaveReview extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $lesson;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $lesson)
    {
        //

        $this->userName = $user['name'];
        $this->lesson = $lesson;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.leaveReview');
    }
}
