<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'textarea' => 'required|string|max:1000',
        ]);

        try {
            // Save the data in the database
            Contact::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'message' => $validatedData['textarea'],
            ]);

            // Attempt to send the email
            Mail::to('duncan.wallace@insight-centre.org')->send(new ContactFormMail($validatedData));

            // Return success response
            return redirect()->back()->with('success', 'Your message has been sent and stored successfully!');

        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Contact form submission failed: ' . $e->getMessage());

            // Return an error response to the user
            return redirect()->back()->with('error', 'There was an error processing your request. Please try again later.');
        }
    }
}
