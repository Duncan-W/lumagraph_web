<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

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

        // Optionally, send an email with the form data
        Mail::to('duncan.wallace@insight-centre.org')->send(new ContactFormMail($validatedData));

        // Return a response, e.g., redirect back with a success message
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}

