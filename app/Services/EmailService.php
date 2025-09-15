<?php

namespace App\Services;

use App\Mail\GenericMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class EmailService
{
    /**
     * Envía un correo usando Blade o Markdown y soporta adjuntos/PDFs.
     *
     * @param string|array $to
     * @param string $subject
     * @param string $template
     * @param array $data
     * @param array $options
     * @param string $type
     * @return bool
     */
    public function sendMail(
        string|array $to,
        string $subject,
        string $template,
        array $data = [],
        array $options = [],
        string $type = 'blade'
    ): bool {
        try {
            $recipients = is_array($to) ? $to : [$to];
            if (empty($recipients)) {
                Log::warning('Intento de envío sin destinatarios', ['template' => $template]);
                return false;
            }

            $mailable = new GenericMail($subject, $template, $data, $type);

            // Opciones: from, reply_to, cc, bcc, priority
            if (isset($options['from'])) {
                $mailable->from($options['from']['email'], $options['from']['name'] ?? null);
            }
            if (isset($options['reply_to'])) {
                $mailable->replyTo($options['reply_to']['email'], $options['reply_to']['name'] ?? null);
            }
            if (isset($options['cc'])) {
                $mailable->cc(is_array($options['cc']) ? $options['cc'] : [$options['cc']]);
            }
            if (isset($options['bcc'])) {
                $mailable->bcc(is_array($options['bcc']) ? $options['bcc'] : [$options['bcc']]);
            }
            if (isset($options['priority'])) {
                $mailable->priority($options['priority']);
            }

            // Adjuntos
            if (isset($options['attachments'])) {
                foreach ($options['attachments'] as $attachment) {
                    $this->processAttachment($mailable, $attachment);
                }
            }

            // Envío: detecta si MAIL_QUEUE_CONNECTION=sync para enviar inmediatamente
            foreach ($recipients as $recipient) {
                // Aquí el cambio clave: usamos send() si el Mailable ya implementa ShouldQueue
                Mail::to($recipient)->send(clone $mailable);
            }

            Log::info('Correo enviado exitosamente', [
                'to' => $to,
                'subject' => $subject,
                'template' => $template,
                'type' => $type
            ]);

            return true;

        } catch (\Exception $e) {
            Log::error('Error al enviar correo', [
                'to' => $to,
                'subject' => $subject,
                'template' => $template,
                'type' => $type,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }

    /**
     * Procesar un adjunto (archivo, datos o URL)
     */
    private function processAttachment($mailable, $attachment): void
    {
        Log::info('Procesando adjunto:', ['attachment' => $attachment]);

        // Archivo desde ruta
        if (is_string($attachment) && file_exists($attachment)) {
            $mailable->attach($attachment, [
                'as' => basename($attachment),
                'mime' => mime_content_type($attachment)
            ]);
            return;
        }

        // Archivo desde datos en memoria
        if (is_array($attachment) && isset($attachment['data'])) {
            $mailable->attachData(
                $attachment['data'],
                $attachment['name'] ?? 'archivo.dat',
                ['mime' => $attachment['mime'] ?? 'application/octet-stream']
            );
            return;
        }

        // Archivo desde URL
        if (is_array($attachment) && isset($attachment['url'])) {
            try {
                $url = $attachment['url'];
                $name = $attachment['name'] ?? basename(parse_url($url, PHP_URL_PATH));
                $tempFile = tempnam(sys_get_temp_dir(), 'mail_attachment_');
                file_put_contents($tempFile, file_get_contents($url));
                $mailable->attach($tempFile, [
                    'as' => $name,
                    'mime' => $attachment['mime'] ?? mime_content_type($tempFile)
                ]);
                register_shutdown_function(function() use ($tempFile) {
                    if (file_exists($tempFile)) unlink($tempFile);
                });
            } catch (\Exception $e) {
                Log::error("Error adjuntando archivo desde URL: " . $e->getMessage());
            }
        }
    }

    /**
     * Métodos específicos para Blade y Markdown
     */
    public function sendBladeMail(string|array $to, string $subject, string $template, array $data = [], array $options = []): bool
    {
        return $this->sendMail($to, $subject, $template, $data, $options, 'blade');
    }

    public function sendMarkdownMail(string|array $to, string $subject, string $template, array $data = [], array $options = []): bool
    {
        return $this->sendMail($to, $subject, $template, $data, $options, 'markdown');
    }

    /**
     * Enviar correo simple de texto
     */
    public function sendSimpleMail(string|array $to, string $subject, string $message, array $options = []): bool
    {
        try {
            Mail::raw($message, function ($mail) use ($to, $subject, $options) {
                $mail->to($to);
                $mail->subject($subject);

                if (isset($options['from'])) {
                    $mail->from($options['from']['email'], $options['from']['name'] ?? null);
                }
                if (isset($options['cc'])) {
                    $mail->cc(is_array($options['cc']) ? $options['cc'] : [$options['cc']]);
                }
                if (isset($options['bcc'])) {
                    $mail->bcc(is_array($options['bcc']) ? $options['bcc'] : [$options['bcc']]);
                }
            });
            return true;
        } catch (\Exception $e) {
            Log::error('Error al enviar correo simple', [
                'to' => $to,
                'subject' => $subject,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Enviar correo con múltiples archivos
     */
    public function sendMailWithFiles(string|array $to, string $subject, string $template, array $data, array $files, array $options = []): bool
    {
        $options['attachments'] = $options['attachments'] ?? [];
        foreach ($files as $file) {
            $options['attachments'][] = $file;
        }
        return $this->sendMail($to, $subject, $template, $data, $options);
    }
}
