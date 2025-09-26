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
            'template' => 'pdf.default', // Plantilla para generar el PDF
            // 'prefix' => 'report-', // Si se desea agregar un prefijo al nombre del archivo (opcional) solo se usa si no existe el filename
            'filename' => 'report-' . Str::uuid()->toString(), // Nombre del archivo (opcional)
            // 'path' => storage_path('app/public'), // Si se desea guardar el archivo en un directorio diferente (opcional)
            'paper_size' => 'a4', // Tamaño de la hoja (opcional)
            'orientation' => 'landscape', // Orientación de la hoja (opcional)
            /*'encryption' => [
                'user' => 'passwordUser',
                'owner' => 'passwordOwner',
                'permissions' => ['print', 'modify', 'copy', 'add']
            ]*/ // Encriptación del PDF (opcional)
        ];

        // Generar y guardar el archivo
        return $this->fileService->generate($data, $options);
    }
}
