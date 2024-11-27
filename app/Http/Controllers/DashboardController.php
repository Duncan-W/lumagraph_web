<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        return view('dashboard', compact('contacts'));
    }
}
