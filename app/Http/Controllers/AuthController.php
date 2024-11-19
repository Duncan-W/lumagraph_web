<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'username' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
            // Authentication passed
            return redirect()->route('dashboard')->with('success', 'Login successful');
        }

        // Authentication failed
        return back()->withErrors(['username' => 'Invalid credentials'])->withInput();
    }
}
