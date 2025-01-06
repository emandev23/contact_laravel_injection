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
            Mail::to($data['email'])->send(new ContactMail($data['message']));
            return true;
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            return false;
        }
    }
}
