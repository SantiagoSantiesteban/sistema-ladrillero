<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        // Enviar correo a través de SMTP / Mailtrap
        Mail::to(config('mail.from.address'))->send(
            new ContactMessage($validated['name'], $validated['email'], $validated['message'])
        );

        return back()->with('success', '¡Su mensaje ha sido enviado exitosamente al equipo de LadrilloWeb!');
    }
}