<?php 

use MmoAndFriends\Mexico\Mexico;
use MmoAndFriends\Mexico\MexicoTrait;

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETAS_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function incluirTemplate( string $nombre ) {
    include TEMPLATES_URL . "/${nombre}.php";
}

function incluirTemplateArray( string $nombre, $info) {
    $_POST["info"] = $info;
    include TEMPLATES_URL . "/${nombre}.php";
}

function debuguear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function validarTipoContenido($tipo) {
    $tipos = ['categorias' , 'productos'];

    return in_array($tipo, $tipos);
}

function mostrarNotificacion($resultado) {
    $mensaje = '';

    switch($resultado) { 
        case 1:
            $mensaje = 'Creado Correctamente';
        break;

        case 2:
            $mensaje = 'Actualizado Correctamente';
        break;

        case 3:
            $mensaje = 'Eliminado Correctamente';
        break;

        case 4:
            $mensaje = 'Su producto se agrego correctamente';
        break;

        default:
            $mensaje = false;
        break;
    }

    return $mensaje;
}

function validarORedireccionar(string $url) {
    // Validar que la URL sea un id valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: ${url}");
    }

    return $id;
} 

function obtenerEstados() {
    $estados = Mexico::estados();

    return $estados;
}

function obtenerCiudad($state) {
    $ciudades = Mexico::municipiosDeEstado($state);

    return $ciudades;
}