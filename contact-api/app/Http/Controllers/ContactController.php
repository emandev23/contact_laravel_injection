<?php

// app/Http/Controllers/ContactController.php
namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $fullName = $request->input('full_name');
        $email = $request->input('email');
        $message = $request->input('message');

        Mail::to('your_email@example.com')
            ->send(new ContactMail($fullName, $email, $message));

        return response()->json([
            'message' => 'Email sent successfully',
        ], 200);
    }
}
