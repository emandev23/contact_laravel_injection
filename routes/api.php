<?php

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

// Route::post('/send-email', function () {
//     $toEmail = 'recipient@example.com';
//     Mail::to($toEmail)->send(new ContactMail(['Hello, this is a test message.']));
//     return 'Email sent!';
// });

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Contact form route
Route::post('/contact', [ContactController::class, 'store']);

// Test route to verify API is working
Route::get('/test', function () {
    return response()->json([
        'message' => 'API is working'
    ]);
});
