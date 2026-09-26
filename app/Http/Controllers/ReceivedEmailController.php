<?php

namespace App\Http\Controllers;

use App\Models\ReceivedEmail;
use Illuminate\Http\Request;

class ReceivedEmailController extends Controller
{
    public function index()
    {
        $emails = ReceivedEmail::latest()->get();
        return view('emails.index', compact('emails'));
    }

    public function show($id)
    {
        $email = ReceivedEmail::findOrFail($id);
        $email->update(['is_read' => true]);

        return view('emails.show', compact('email'));
    }
}