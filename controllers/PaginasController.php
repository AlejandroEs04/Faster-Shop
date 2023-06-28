<?php

namespace Controllers;

use Model\Categorias;
use Model\Productos;
use Controllers\UsuarioController;
use MVC\Router;

class PaginasController {
    public static function index(Router $router) {

        $productos = Productos::all();
        $categorias = Categorias::all();

        if($_GET['category']) {
            $productos = Productos::where('categoriaID', $_GET['category']);
        }
        if($_GET['category'] === '0') {
            $productos = Productos::all();
        }
        

        $router->render('paginas/index', [
            'productos' => $productos,
            'categorias' => $categorias
        ]);
    }
}