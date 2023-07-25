<?php

namespace Controllers;

use Model\Carrito;
use Model\Categorias;
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
        $usuarioId = $_SESSION['id'];
        $errores = [];
        

        if($_GET['error']) {
            Usuarios::setAlerta('error', 'La cantidad es obligatoria');
        }

        $producto = Productos::findArray($id);

        $errores = Usuarios::getErrores();

        $errores = $errores['error'];

        $router->render('paginas/producto', [
            'usuarioId' => $usuarioId,
            'producto' => $producto,
            'errores' => $errores
        ]);
    }

    public static function categoria(Router $router) {

        $categoriaId = $_GET['tipo'];
        $categorias = Categorias::all();
        $categoriaUna = Categorias::findArray($categoriaId);
        $productos = Productos::where('categoriaID', $categoriaId);

        $router->render('paginas/categoria', [
            'categoriasSeccion' => $categorias,
            'categoriaUna' => $categoriaUna,
            'productos' => $productos
        ]);
    }
}