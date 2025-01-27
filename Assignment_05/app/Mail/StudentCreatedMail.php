<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

/**
 * Summary of StudentCreatedMail
 */
class StudentCreatedMail extends Mailable
{
     public $student;

    /**
     * Summary of __construct
     *
     * @param object $student
     */
    public function __construct(object $student)
    {
        $this->student = $student;
    }

    /**
     * Add Subject
     *
     * @return Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to New Student Creation',
        );
    }

    /**
     * Get content
     *
     * @return Content
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.student_created_info',
            with: [
                'studentName' => $this->student->name,
                'studentEmail' => $this->student->email,
                'studentPhone' => $this->student->phone,
                'studentAddress' => $this->student->address,
                'studentMajor' => $this->student->major->name,
            ],
        );
    }
}
