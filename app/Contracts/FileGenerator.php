<?php

namespace App\Contracts;

/**
 * Interface FileGenerator
 */
interface FileGenerator
{
    /**
     * Interfaz para generar archivos
     *
     * @param array $data datos para generar el archivo
     * @param array $options opciones para generar el archivo
     * @return string ruta del archivo guardado
     */
    public function generate(array $data, array $options): string;
}
