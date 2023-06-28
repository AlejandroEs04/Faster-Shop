<?php

namespace Controllers;

use Model\Carrito;
use Model\Productos;
use Model\Usuarios;
use MVC\Router;

class SeccionesController {
    public static function productos(Router $router) {

        $router->render('paginas/productos', [

        ]);
    }

    public static function producto(Router $router) {

        $id = $_GET['id'];
        $errores = [];
        

        if($_GET['error']) {
            Usuarios::setAlerta('error', 'La cantidad es obligatoria');
        }

        $producto = Productos::findArray($id);

        $errores = Usuarios::getErrores();

        $errores = $errores['error'];

        $router->render('paginas/producto', [
            'producto' => $producto,
            'errores' => $errores
        ]);
    }

    public static function categoria(Router $router) {

        $router->render('paginas/categoria', [

        ]);
    }
}