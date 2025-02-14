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

    public $customer_name;
    public $email;
    public $message;

    public function __construct($fullName, $email, $message)
    {
        $this->customer_name = $fullName;
        $this->email = $email;
        $this->message = $message;
    }
    public function build()
    {
        return $this->subject('New Contact Form Submission')
                    ->markdown('emails.test')
                    ->with([
                        'customer_name' => $this->customer_name,
                        'email' => $this->email,
                        'message' => $this->message,
                    ]);
    }
}
