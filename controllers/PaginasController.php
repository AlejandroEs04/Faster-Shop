<?php

namespace Controllers;

use Model\Categorias;
use Model\Productos;
use Controllers\UsuarioController;
use Model\Proveedores;
use MVC\Router;

class PaginasController {
    public static function index(Router $router) {
        $productos = Productos::all();
        $categorias = Categorias::all();
        $proveedores = Proveedores::all();

        $info = [
            'categorias' => $categorias,
            'proveedores' => $proveedores
        ];
        $categoriasSeccion = Categorias::get(6);

        if($_GET['category']) {
            $productos = Productos::where('categoriaID', $_GET['category']);
        }
        if($_GET['price']) {
            $productos = Productos::range('price', $_GET['price']);
        }
        

        $router->render('paginas/index', [
            'categoriasSeccion' => $categoriasSeccion,
            'productos' => $productos,
            'categorias' => $categorias,
            'info' => $info
        ]);
    }
}