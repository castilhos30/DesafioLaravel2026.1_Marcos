<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminMensagemMail extends Mailable
{
    use Queueable, SerializesModels;

    public $assunto;
    public $mensagem;

    public function __construct($assunto, $mensagem)
    {
        $this->assunto = $assunto;
        $this->mensagem = $mensagem;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->assunto, 
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin_mensagem', 
        );
    }
}