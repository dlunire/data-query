<?php

use DLRoute\Requests\DLRoute;
use DLStorage\Storage\SaveData;
use DLUnire\Auth\Auth;
use DLUnire\Controllers\Admin\Person\PersonController;
use DLUnire\Models\Tables\SendMail;
use DLUnire\TestController;

/** @var Auth $auth */
$auth = Auth::get_instance();

$auth->authenticated(function () {
    # Permite comprobar si el usuario ha sido autenticado para una petición por 
    # medio de una API.
    DLRoute::get('/logged', function () {
    });
});


// Visualizar dirección IP
DLRoute::get('/ip', [TestController::class, 'ip']);

# Devuelve las primeras 10 personas
DLRoute::get('/api/v1/register', [PersonController::class, 'person']);

## Devuelve un número de personas por página
DLRoute::get('/api/v1/register/{page}/{rows}', [PersonController::class, 'person'])->filter_by_type([
    "page" => "integer",
    "rows" => "integer"
]);

DLRoute::get("/fotos/{page}/{rows}", [PersonController::class, 'get_photos'])->filter_by_type([
    "page" => "integer",
    "rows" => "integer"
]);

DLRoute::get('/fotos/{cedula}', [PersonController::class, 'document'])->filter_by_type([
    "cedula" => "integer"
]);

DLRoute::get('/profile/{cedula}', [PersonController::class, 'profile'])->filter_by_type([
    "cedula" => "integer"
]);

DLRoute::get('/usuarios/{page}/{rows}', [PersonController::class, 'usuario'])->filter_by_type([
    "page" => "integer",
    "rows" => "integer"
]);

class Data extends SaveData {
}

DLRoute::get('/cifrado', function () {

    $data = new Data();

    /** @var string $entropia */
    $entropia = "Una cadena de textos";

    /** @var string $content */
    $content = "Un contenido que podemos cifrar. Contenido cambiado";

    return view_pdf('test', [
        "entropia" => $entropia,
        "contenido" => $content,
        "cifrado" => $data->encode($content, $entropia)
    ]);
});
