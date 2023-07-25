<?php

namespace Controllers;

use GuzzleHttp\Psr7\Header;
use Model\Carrito;
use Model\Categorias;
use Model\Productos;
use Model\Usuarios;
use MVC\Router;

class UsuarioController {
    public static function index(Router $router) {

        $usuarioId = $_SESSION['idOriginal'];

        $datos = [
            'id',
            'name'
        ];

        $carrito = Carrito::where('usuarioId', $usuarioId);

        $productos = []; 
        $total = 0;
        $cantidadProductos = 0;
        $i = 0;

        foreach($carrito as $producto) {
            $productos[$i] = Productos::findArray($producto->productoId);
            $total = $total + $producto->precio;
            $cantidadProductos = $cantidadProductos + $producto->cantidad;

            $i++;
        }
        
        $usuario = Usuarios::getData($datos, $usuarioId);
        
        $router->render('usuario/index', [
            'carrito' => $carrito,
            'productos' => $productos,
            'usuario' => $usuario,
            'total' => $total,
            'cantidad' => $cantidadProductos
        ]);
    }

    public static function carrito(Router $router) {

        $carrito = new Carrito;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $productoId = $_GET['id'];
            $usuarioId = $_SESSION['idOriginal'];
            $cantidad = $_POST['cantidad'];
            $cantidadInput = $_POST['cantidadInput'] ?? null;

            if($_POST['eliminar']) {
                $productoId = $_GET['id'];
                $productoId = filter_var($productoId, FILTER_VALIDATE_INT);

                if($productoId) {
                    // Validar que el producto exista 
                    $existe = Carrito::where('productoId', $productoId);
        
                    if(empty($existe)) {
                        header('location: /admin');
                    } else {
                        $existe[0]->eliminar();
                    }
                }
                header('location: /usuario?id=' . $usuarioId);
            }

            if($_POST['comprar']) {
                header('location: /comprar?id=' . $usuarioId . "&productoId=" . $productoId);
                return;
            }

            if($cantidad === '') {
                header('Location: /producto?id=' . $productoId . '&error=' . true);
                return;
            }

            $producto = Productos::findArray($productoId);
            $productoPrecio = $producto->price;
            $OtrosProductos = Carrito::getTwoVariables('productoId', 'usuarioId', $productoId, $usuarioId);

            if(empty($OtrosProductos)) {
                $precio = $cantidad * $productoPrecio;

                $carritoArray = [
                    "usuarioId" => $usuarioId,
                    "productoId" => $productoId,
                    "cantidad" => $cantidad,
                    "precio" => $precio
                ];

                $carrito = new Carrito($carritoArray);
                $carrito->guardar();
                header('Location: /producto?id=' .  $productoId . "&resultado=4" );
            } else {
                if($cantidadInput) {
                    $cantidad = ($OtrosProductos->cantidad - $cantidadInput) * -1;
                }
                $cantidad = $cantidad + $OtrosProductos->cantidad;
                $precio = $cantidad * $productoPrecio;

                $carritoArray = [
                    'id' => $OtrosProductos->id,
                    "usuarioId" => $usuarioId,
                    "productoId" => $productoId,
                    "cantidad" => $cantidad,
                    "precio" => $precio
                ];
                
                $carrito = new Carrito($carritoArray);

                $carrito->guardar();
                header('Location: /usuario?id=' .  $usuarioId . "&resultado=4" );
            }
        }

        $router->render('usuario/carrito', [

        ]);
    }

    public static function comprar(Router $router) {
        $productoId = $_GET['$productoId'];
        $usuarioId = $_GET['id'];

        $usuario = Usuarios::findArray($usuarioId);

        $router->render('usuario/comprar', [
            'usuario' => $usuario
        ]);
    }
}