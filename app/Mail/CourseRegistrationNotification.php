<?php

namespace App\Mail;

use App\Models\CourseRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CourseRegistrationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;

    public function __construct(CourseRegistration $registration)
    {
        $this->registration = $registration;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo($this->registration->email, $this->registration->full_name)
            ->to('info@lacfontaine.org')
            ->subject('New Course Registration: ' . $this->registration->course->title)
            ->view('emails.courseRegistrationNotification');
    }

    public function attachments(): array
    {
        return [];
    }
}
