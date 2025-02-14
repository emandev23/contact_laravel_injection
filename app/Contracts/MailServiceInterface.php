<?php
namespace App\Contracts;

interface MailServiceInterface
{
    public function sendContactMail(array $data): bool;
}
