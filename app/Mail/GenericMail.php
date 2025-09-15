<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenericMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subject; // Asunto
    public $template; // Plantilla
    public $data; // Datos a enviar en la plantilla
    public $type; // blade o markdown
    public $attachments = []; // Adjuntos

    /**
     * Create a new message instance.
     */
    public function __construct(string $subject, string $template, array $data = [], string $type = 'blade', array $attachments = [])
    {
        $this->subject = $subject;
        $this->template = $template;
        $this->data = $data;
        $this->type = $type;
        $this->attachments = $attachments;

        // Configurar cola por defecto
        $this->onQueue('emails');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        if ($this->type === 'markdown') {
            return new Content(
                markdown: $this->template,
                with: $this->data,
            );
        }

        return new Content(
            view: $this->template,
            with: $this->data,
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachObjects = [];

        foreach ($this->attachments as $file) {
            // Si es una ruta de archivo
            if (is_string($file) && file_exists($file)) {
                $attachObjects[] = Attachment::fromPath($file)
                ->as(basename($file))
                ->withMime(mime_content_type($file));
            } elseif (is_array($file) && isset($file['data'])) { // Si es un archivo en memoria
                $attachObjects[] = Attachment::fromData(
                    fn() => $file['data'],
                    $file['name'] ?? 'archivo.dat'
                )->withMime($file['mime'] ?? 'application/octet-stream');
            } elseif (is_array($file) && isset($file['url'])) { // Si es una URL
                $attachObjects[] = Attachment::fromUrl($file['url'])
                ->as($file['name'] ?? basename(parse_url($file['url'], PHP_URL_PATH)))
                ->withMime($file['mime'] ?? 'application/octet-stream');
            }
        }

        return $attachObjects;
    }

    /**
     * Determine the time at which the job should timeout.
     *
     * @return \DateTime
     */
    public function retryUntil()
    {
        return now()->addMinutes(5);
    }
}
