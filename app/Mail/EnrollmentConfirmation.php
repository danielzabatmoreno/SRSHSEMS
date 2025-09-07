<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\StudentRegistration;

class EnrollmentConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $missing; // track missing items

    public function __construct(StudentRegistration $student, $missing = [])
    {
        $this->student = $student;
        $this->missing = $missing;
    }


    public function build()
    {
        return $this->subject('Enrollment Submitted Successfully')
                    ->view('emails.enrollment_confirmation');
    }
}
