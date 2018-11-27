<?php

namespace App\Mail;

use App\ApplicationCVForm;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompletedOffer extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var ApplicationCVForm
     */
    public $student;

    /**
     * Create a new message instance.
     *
     * @param ApplicationCVForm $student
     */
    public function __construct(ApplicationCVForm $student)
    {
        $this->student = $student;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.completed_offer');
    }
}
