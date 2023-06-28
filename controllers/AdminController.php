<?php

namespace Controllers;

use Model\Categorias;
use Model\Productos;
use MVC\Router;

class AdminController {
    public static function inicio(Router $router) {

        $productos = Productos::all();

        $categorias = Categorias::all();

        $router->render('admin/index', [
            'productos' => $productos,
            'categorias' => $categorias
        ]);
    }
}