<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\EmailService;
use App\Services\FileGenerators\PdfGenerator;

class TestMailController extends Controller
{
    protected $emailService;
    protected $pdfService;

    public function __construct(EmailService $emailService, PdfGenerator $pdfService)
    {
        $this->emailService = $emailService;
        $this->pdfService = $pdfService;
    }

    // Enviar correo con Blade
    public function blade(Request $request)
    {
        $to = $request->input('to', ['bycarmona141@gmail.com', 'bycarmona117@gmail.com']);
        $subject = 'Correo Test Blade';
        $template = 'emails.blade.default';
        $data = ['nombre' => 'Usuario de prueba'];

        $this->emailService->sendBladeMail($to, $subject, $template, $data);

        return response()->json(['status' => 'enviado']);
    }

    // Enviar correo con Markdown
    public function markdown(Request $request)
    {
        $to = $request->input('to', ['bycarmona141@gmail.com', 'bycarmona117@gmail.com']);
        $subject = 'Correo Test Markdown';
        $template = 'emails.markdown.default';
        $data = ['nombre' => 'Usuario de prueba'];

        $this->emailService->sendMarkdownMail($to, $subject, $template, $data);

        return response()->json(['status' => 'enviado']);
    }

    // Enviar correo simple (sin plantilla)
    public function simple(Request $request)
    {
        $to = $request->input('to', ['bycarmona141@gmail.com', 'bycarmona117@gmail.com']);
        $subject = 'Correo Test Texto Simple';
        $message = 'Este es un mensaje simple de prueba enviado desde TestMailController.';

        $this->emailService->sendSimpleMail($to, $subject, $message);

        return response()->json(['status' => 'enviado']);
    }

    // Enviar correo con adjuntos
    public function withAttachment(Request $request)
    {
        $to = $request->input('to', ['bycarmona141@gmail.com', 'bycarmona117@gmail.com']);
        $subject = 'Correo Test con Adjuntos';
        $template = 'emails.blade.default';
        $data = ['nombre' => 'Usuario de prueba'];

        $options = [
            'attachments' => [
                storage_path('app/public/documento.pdf'),
                storage_path('app/public/Aspirantes.xlsx')
            ]
        ];

        $this->emailService->sendMail($to, $subject, $template, $data, $options);

        return response()->json(['status' => 'enviado']);
    }


    // Enviar correo con pdf generado
    public function withPdf()
    {
        // Datos para generar el PDF (los datos que se pasan a la vista blade)
        $dataPdf = [
            'title' => 'Reporte de prueba',
            'content' => 'Este es un contenido de prueba para el documento PDF generado desde Laravel.'
        ];

        // Opciones para generar el PDF
        $options = [
            'view' => 'pdf.default',
            'filename' => 'report-' . Str::uuid()->toString(),
            // 'path' => storage_path('app/public'),
            'paper_size' => 'a4',
            'orientation' => 'landscape',
            /*'encryption' => [
                'user' => 'passwordUser',
                'owner' => 'passwordOwner',
                'permissions' => ['print', 'modify', 'copy', 'add']
            ]*/
        ];

        // Generar y guardar el archivo
        $path = $this->pdfService->generate($dataPdf, $options);

        // Archivo para adjuntar en el correo
        $options = [
            'attachments' => [
                $path
            ]
        ];

        // Datos para el envio de correos
        $to = ['bycarmona141@gmail.com', 'bycarmona117@gmail.com'];
        $subject = 'Correo Test con Pdf generado';
        $templateEmail = 'emails.blade.default';
        $dataEmail = ['nombre' => 'Usuario de prueba'];

        $this->emailService->sendMail($to, $subject, $templateEmail, $dataEmail, $options);

        return response()->json(['status' => 'enviado']);
    }
}
