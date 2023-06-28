<?php

namespace Controllers;

use GuzzleHttp\Psr7\Header;
use Model\Carrito;
use Model\Productos;
use Model\Usuarios;
use MVC\Router;

class UsuarioController {
    public static function index(Router $router) {

        $usuarioId = $_SESSION['idOriginal'];

        $usuario = Usuarios::findArray($usuarioId);
        
        $router->render('usuario/index', [
            'usuario' => $usuario
        ]);
    }

    public static function carrito(Router $router) {

        $carrito = new Carrito;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $productoId = $_GET['id'];
            $usuarioId = $_SESSION['id'];
            $cantidad = $_POST['cantidad'];

            if($cantidad === '') {
                header('Location: /producto?id=' . $productoId . '&error=' . true);
                return;
            }

            $producto = Productos::findArray($productoId);
            $productoPrecio = $producto->price;

            $precio = $cantidad * $productoPrecio;

            $carritoArray = [
                "usuarioId" => $usuarioId,
                "productoId" => $productoId,
                "cantidad" => $cantidad,
                "precio" => $precio
            ];

            if($_POST['carrito']) {
                // Guardar producto en carrito
                $carrito = new Carrito($carritoArray);

                debuguear($carrito);

            } else {
                // Mandar a la pagina de comprar con el producto

            }
        }

        
    }
}