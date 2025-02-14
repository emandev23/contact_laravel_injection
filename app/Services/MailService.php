<?php
namespace App\Services;

use App\Contracts\MailServiceInterface;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class MailService implements MailServiceInterface
{
    public function sendContactMail(array $data): bool
    {
        try {
            \Log::info('Starting email send process with data:', $data);
            
            // Create the mail instance
            $mail = new ContactMail(
                $data['full_name'],
                $data['email'],
                $data['message']
            );
            
            \Log::info('Mail instance created successfully');
            
            // Attempt to send the email
            Mail::to('imanemakroum44@gmail.com')  // Change this to your admin email
                ->send($mail);
            
            \Log::info('Email sent successfully to admin');
            return true;
        } catch (\Exception $e) {
            \Log::error('Mail sending failed. Error: ' . $e->getMessage());
            \Log::error('Error occurred on line: ' . $e->getLine());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return false;
        }
    }
}
