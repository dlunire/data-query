<?php

declare(strict_types=1);

namespace DLUnire\Controllers\Admin\Person;

use DLRoute\Config\FileInfo;
use DLUnire\Models\DTO\FastArray;
use DLUnire\Models\Tables\Fotos;
use DLUnire\Models\Tables\SendMail;
use DLUnire\Models\Tables\Usuario;
use DLUnire\Services\Traits\TypeTrait;
use Framework\Abstracts\BaseController;
use League\Csv\InvalidArgument;

/**
 * Devuelve una lista de personas
 * 
 * @package DLUnire\Controllers\Admin\Person
 * @version 0.0.1 (release)
 * @author Códigos del Futuro (@cdelfuturo)
 * @copyright 2025 - Códigos del Futuro
 * @license MIT
 */
final class PersonController extends BaseController {
    use TypeTrait;

    /**
     * Devuelve una lista de datos
     * 
     * @param object{page: int, rows: int}|null $params Parámetros de la petición
     * @return array
     */
    public function person(object $params): array {
        /** @var boolean $is_document */
        $is_document = $this->get_boolean('is-document');

        if ($is_document) {
            return $this->get_person($params);
        }

        return $this->get_data($params);
    }

    /**
     * Devuelve los datos en formato array
     * 
     * @param object{page: int, rows: int}|null $params Parámetros de la petición
     * @return array
     */
    private function get_data(object $params): array {
        /** @var int $page */
        $page = intval($params?->page ?? 1);

        /** @var int $rows */
        $rows = intval($params?->rows ?? 10);

        if ($page < 1) {
            $page = 1;
        }

        if ($rows < 1) {
            $rows = 10;
        }

        return SendMail::order_by('ccedula')->asc()->paginate($page, $rows);
    }

    /**
     * Devuelve el nombre del persona por el número de documento
     * 
     * @return array
     */
    private function get_person(): array {
        return SendMail::where('ccedula', strval($this->get_integer('document-number')))->first();
    }

    /**
     * Devuelve un registro con fotos en formato JSON
     * 
     * @param object{page: int, rows: int} $params Parámetros de la petición.
     * @return array
     */
    public function get_photos(object $params): array {
        $data = Fotos::order_by('ced_pro')->asc()->select('ced_pro')->paginate($params->page, $params->rows);

        /** @var int[] $documents */
        $documents = [];

        foreach ($data['register'] ?? [] as $register) {
            /** @var int|null $document */
            $document = $register['ced_pro'] ?? null;
            if (!is_integer($document)) continue;

            $documents[] = $document;
        }

        $data['register'] = $documents;

        return $data;

    }

    /**
     * Imprime la foto del documento en pantalla
     * 
     * @param object $params Parámetros de la petición
     * @return void
     */
    public function document(object $params): void {
        $this->print_photo('cedula_pro', $params);
    }

    /**
     * Imprime la foto de perfil en pantalla
     * 
     * @param object $params Parámetros de la petición
     * @return void
     */
    public function profile(object $params): void {
        $this->print_photo('foto_pro', $params);
    }

    public function usuario(object $params): array {
        return Usuario::paginate($params->page, $params->rows);
    }

    /**
     * Imprime la foto en pantalla
     * 
     * @param string $field Campo a ser seleccionado para la foto
     * @param object $params Parámetro de la petición
     * @return void 
     * 
     * @throws InvalidArgument
     */
    private function print_photo(string $field, object $params): void {

        if ($field != "foto_pro" && $field != "cedula_pro") {
            throw new InvalidArgument("print_photo(): Se esperaba «foto_pro» o «cedula_pro» en \$field", 500);
        }

        /** @var array $data */
        $data = Fotos::where('ced_pro', (string) $params->cedula)->first();

        /** @var FastArray $current_data */
        $current_data = new FastArray($data);

        if ($current_data->length() < 1) {
            return;
        }

        /** @var string $content */
        $content = strval($data['cedula_pro'] ?? null);
        if (!$content || empty($content)) return;

        /** @var string | false $mimetype */
        $mimetype = $this->get_mimetype_by_content($content);
        if (!$mimetype) return;

        header("content-type: {$mimetype}");
        print_r($data['cedula_pro']);
        exit;
    }
}
