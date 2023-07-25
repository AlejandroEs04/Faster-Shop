<?php

use Controllers\PaginasController;
use Controllers\SeccionesController;
use Controllers\AuthController;
use Controllers\UsuarioController;
use Controllers\AdminController;
use Controllers\CategoriasController;
use Controllers\ProductosController;
use MVC\Router;

require_once __DIR__ . "../../includes/app.php";

$router = new Router();

/** ZONA PUBLICA **/
$router->get('/', [PaginasController::class, 'index']);
$router->post('/', [PaginasController::class, 'index']);
$router->get('/producto-compra', [PaginasController::class, 'producto']);
$router->post('/producto-compra', [PaginasController::class, 'producto']);

/** SECCIONES **/
$router->get('/producto', [SeccionesController::class, 'producto']);
$router->get('/productos', [SeccionesController::class, 'productos']);
$router->get('/categoria', [SeccionesController::class, 'categoria']);

/** ZONA DE USUARIOS **/
// Inicio
$router->get('/usuario', [UsuarioController::class, 'index']);
$router->get('/carrito', [UsuarioController::class, 'carrito']);
$router->post('/carrito', [UsuarioController::class, 'carrito']);

// Login and logout
$router->get('/inicio-sesion', [AuthController::class, 'login']);
$router->post('/inicio-sesion', [AuthController::class, 'login']);
$router->get('/crear-cuenta', [AuthController::class, 'createAccount']);
$router->post('/crear-cuenta', [AuthController::class, 'createAccount']);
$router->get('/cerrar-sesion', [AuthController::class, 'logout']);
$router->get('/logout', [AuthController::class, 'logout']);

// Confirmar cuenta
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);
$router->get('/mensaje', [AuthController::class, 'mensaje']);

/** ZONA PRIVADA **/
$router->get('/admin', [AdminController::class, 'inicio']);

// Productos
$router->get('/crear-producto', [ProductosController::class, 'crearProducto']);
$router->post('/crear-producto', [ProductosController::class, 'crearProducto']);
$router->get('/actualizar-producto', [ProductosController::class, 'actualizarProducto']);
$router->post('/actualizar-producto', [ProductosController::class, 'actualizarProducto']);
$router->get('/eliminar-producto', [ProductosController::class, 'eliminar']);

// Categorias
$router->get('/crear-categoria', [CategoriasController::class, 'crearCategoria']);
$router->post('/crear-categoria', [CategoriasController::class, 'crearCategoria']);
$router->get('/actualizar-categoria', [CategoriasController::class, 'actualizarCategoria']);
$router->post('/actualizar-categoria', [CategoriasController::class, 'actualizarCategoria']);
$router->get('/eliminar-categoria', [CategoriasController::class, 'eliminar']);


/** COMPRAR **/
$router->post('/comprar', [UsuarioController::class, 'comprar']);
$router->get('/comprar', [UsuarioController::class, 'comprar']);

$router->comprobarRutas();