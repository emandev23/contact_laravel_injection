<?php

// app/Http/Controllers/ContactController.php
namespace App\Http\Controllers;

use App\Contracts\MailServiceInterface;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $mailService;

    public function __construct(MailServiceInterface $mailService)
    {
        $this->mailService = $mailService;
    }

    public function store(Request $request)
    {
        try {
            // Get data from either query parameters or JSON body
            $data = $request->isJson() ? $request->json()->all() : $request->all();
            
            \Log::info('Contact form request received', $data);

            $validated = $request->validate([
                'full_name' => 'required|string',
                'email' => 'required|email',
                'message' => 'required|string',
            ]);

            \Log::info('Validation passed', $validated);

            $success = $this->mailService->sendContactMail($validated);

            \Log::info('Mail service response:', ['success' => $success]);

            if (!$success) {
                \Log::error('Mail service returned false');
                return response()->json([
                    'message' => 'Failed to send email',
                    'debug_info' => 'Check logs for details'
                ], 500);
            }

            return response()->json([
                'message' => 'Email sent successfully',
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Controller error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'message' => 'Error processing request',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
