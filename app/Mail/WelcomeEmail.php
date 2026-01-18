<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user; // Aquí guardamos al usuario

    // El constructor recibe al usuario
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    // Asunto del correo
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Benvingut a la Lliga Femenina! ⚽',
        );
    }

    // Qué vista (HTML) vamos a usar
    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}