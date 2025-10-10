<?php

declare(strict_types=1);

namespace DLUnire\Services\Traits;

/**
 * Analizador de formato de archivos
 * 
 * @package DLUnire\Services\Traits
 * @version v0.0.1
 * @author Códigos del Futuro (@cdelfuturo)
 * @copyright 2025 - Códigos del Futuro (@cdelfuturo)
 * @license MIT
 */
trait TypeTrait {

    /**
     * Devuelve el mimetype del contenido analizado
     * 
     * @param string $contenido Contenido binario a ser analizado
     * @return string | false
     */
    public function get_mimetype_by_content(string $content): string | false {
        /**
         * Abrir el manejador de FileInfo
         * 
         * @var \finfo|false $finfo
         */
        $finfo = finfo_open(FILEINFO_MIME_TYPE);

        /**
         * Obtener el tipo MIME directamente del contenido
         * 
         * @var string|false $mime_type
         */
        $mime_type = finfo_buffer($finfo, $content);

        finfo_close($finfo);

        return $mime_type;
    }
}
