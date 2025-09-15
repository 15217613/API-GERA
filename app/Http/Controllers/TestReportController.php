<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\FileGenerators\PdfGenerator;

class TestReportController extends Controller
{
    protected $fileService;

    public function __construct(PdfGenerator $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Genera un reporte en PDF
     */
    public function generatePdf(Request $request)
    {
        // Datos para generar el PDF (los datos que se pasan a la vista blade)
        $data = [
            'title' => 'Reporte de prueba',
            'content' => 'Este es un contenido de prueba para el documento PDF generado desde Laravel.'
        ];

        // Opciones para generar el PDF
        $options = [
            'template' => 'pdf.default',
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
        return $this->fileService->generate($data, $options);
    }
}
