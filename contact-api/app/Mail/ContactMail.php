<?php
// app/Mail/ContactFormMail.php
// app/Mail/ContactFormMail.php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $fullName;
    public $email;
    public $message;

    public function __construct($fullName, $email, $message)
    {
        $this->fullName = $fullName;
        $this->email = $email;
        $this->message = $message;
    }
    public function build()
    {
        return $this->subject('New Contact Form Submission')
                    ->view('emails.test', [
                        'customer_name' => $this->fullName,
                        'email' => $this->email,
                        'message' => $this->message,
                    ]);
    }
}
