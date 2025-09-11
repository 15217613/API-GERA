<?php

namespace App\Services\FileGenerators;

use Illuminate\Support\Str;
use App\Contracts\FileGenerator;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class PdfGenerator implements FileGenerator
{
    /**
     * Genera un PDF, lo guarda en el disco y retorna la ruta del archivo.
     *
     * @param array $data Los datos para pasar a la vista.
     * @param array $options Opciones de generación (ej. 'view', 'filename', 'disk').
     * @return string La ruta del archivo guardado.
     */
    public function generate(array $data, array $options): string
    {
        // Determina la vista
        $view = $options['view'] ?? 'pdf.default';

        // Determina el nombre del archivo
        $filename = $options['filename'] ?? $this->generateUniqueFilename($options['prefix'] ?? 'document');

        // Determina la ruta del archivo
        $path = $options['path'] ?? storage_path('app/public/pdf');

        // Carga la vista con los datos
        $pdf = PDF::loadView($view, $data);

        // Guarda el PDF en el disco
        $pdf->save($path . '/' . $filename);

        return $path . '/' . $filename;
    }

    /**
     * Genera un nombre de archivo único con la extensión .pdf.
     *
     * @return string
     */
    protected function generateUniqueFilename($prefix = 'document'): string
    {
        return $prefix . '-' . Str::uuid()->toString() . '.pdf';
    }
}
