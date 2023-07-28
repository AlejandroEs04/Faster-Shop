<?php

namespace Controllers;

use GuzzleHttp\Psr7\Header;
use Model\Carrito;
use Model\Categorias;
use Model\Direcciones;
use Model\Productos;
use Model\Tarjetas;
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

        $usuarioId = $_SESSION['idOriginal'];
        // Obtener la informacion del usuario
        $usuario = Usuarios::findArray($usuarioId);

        // Obtener si existen direcciones o tarjetas vinculadas con el usuario
        $direcciones = Direcciones::where('usuarioId', $usuarioId);

        if($_GET['productoId']){
            $producto = Productos::findArray($_GET['productoId']);

            $cantidad = 1;
            $total = $producto->price;
        } else {
            // Obtener el carrito del usuario
            $carrito = Carrito::where('usuarioId', $usuarioId);

            $i = 0;
            $total = 0;
            $cantidad = 0;
            foreach($carrito as $productosCarrito) {
                $productos[$i] = Productos::findArray($productosCarrito->productoId);
                $total = $total + $productosCarrito->precio;
                $cantidad = $cantidad + $productosCarrito->cantidad;
                $i++;
            }
        }

        if(empty($direcciones)) {
            $InluirDireccion = 'FormularioDireccion';
        } else {
            $InluirDireccion = 'InformacionDireccion';
        }

        $router->render('usuario/comprar', [
            'usuario' => $usuario,
            'direcciones' => $direcciones,
            'InluirDireccion' => $InluirDireccion,
            'carrito' => $carrito,
            'productos' => $productos,
            'producto' => $producto,
            'total' => $total,
            'cantidad' => $cantidad
        ]);
    }

    public static function nuevaDireccion(Router $router) {
        $direccion = new Direcciones;
        $idUsuario = $_SESSION['idOriginal'];
        $_POST['direccion']['usuarioId'] = $idUsuario;

        $direccion = new Direcciones($_POST['direccion']);

        $errores = $direccion->validar();
        if(empty($errores)) {
            $direccion->guardarUsuario();

            header('Location: /comprar');
        }
    }

    public static function nuevaTarjeta(Router $router) {
        $tarjeta = new Tarjetas;
        $idUsuario = $_SESSION['idOriginal'];
        $_POST['tarjeta']['usuarioId'] = $idUsuario;

        debuguear($_POST);
    }
}