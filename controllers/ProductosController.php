<?php

namespace Controllers;

use Model\Categorias;
use Model\Productos;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class ProductosController {
    public static function crearProducto(Router $router) {
        // Obtener registros o crear nuevas instancias
        $producto = new Productos;
        $categorias = Categorias::all();
        $errores = Productos::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crear una nueva instancia
            $producto = new Productos($_POST['product']);
            
            // Generar un nombre unico para la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

            // Setear la imagen
            if($_FILES['product']['tmp_name']['image']) {
                // Realizar un resize a la imagen con intervention
                $image = Image::make($_FILES['product']['tmp_name']['image'])->fit(800, 800);
                $producto->setImagen($nombreImagen);
            }

            $errores = $producto->validar();

            // Revisar que el arreglo de errores este vacio
            if(empty($errores)) {
                // Crear la carpeta para subir imagenes
                if (!is_dir(CARPETAS_IMAGENES)) {
                    mkdir(CARPETAS_IMAGENES);
                }

                // Guarda la imagen en el servidor
                $image->save(CARPETAS_IMAGENES . $nombreImagen);

                // Guardar registro en la base de datos
                $producto->guardar();
            }
        }

        $router->render('productos/crear', [
            'categorias' => $categorias
        ]);
    }

    public static function actualizarProducto(Router $router) {
        // Obtener registros o crear nuevas instancias
        $id = $_GET['id'];

        debuguear($id);

        $router->render('productos/actualizar', [

        ]);
    }

    public static function eliminar() {
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {
            // Validar que el producto exista 
            $existe = Productos::findArray($id);

            if(empty($existe)) {
                header('location: /admin');
            } else {
                $existe->eliminar();
            }
        }
    }
}