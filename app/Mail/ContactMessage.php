<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable 
{ 
    use Queueable, SerializesModels; 
 
    public function __construct( 
        public string $name, 
        public string $email, 
        public string $message 
    ) {} 
 
    public function envelope(): Envelope 
    { 
        return new Envelope( 
            subject: 'Nuevo mensaje desde el CMS', 
            replyTo: [$this->email], 
        ); 
    } 
 
    public function content(): Content 
    { 
        return new Content( 
            view: 'emails.contact', 
        ); 
    } 
}