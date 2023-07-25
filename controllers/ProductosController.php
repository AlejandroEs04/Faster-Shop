<?php

namespace Controllers;

use Model\Categorias;
use Model\Productos;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Proveedores;

class ProductosController {
    public static function crearProducto(Router $router) {
        // Obtener registros o crear nuevas instancias
        $producto = new Productos;
        $categorias = Categorias::all();
        $proveedores = Proveedores::all();
        $errores = Productos::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crear una nueva instancia
            $producto = new Productos($_POST['producto']);
            
            // Generar un nombre unico para la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

            // Setear la imagen
            if($_FILES['producto']['tmp_name']['image']) {
                // Realizar un resize a la imagen con intervention
                $image = Image::make($_FILES['producto']['tmp_name']['image'])->fit(800, 800);
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
            'categorias' => $categorias,
            'proveedores' => $proveedores
        ]);
    }

    public static function actualizarProducto(Router $router) {
        // Obtener registros o crear nuevas instancias
        
        $id = validarORedireccionar('/admin');

        $producto = Productos::findArray($id);
        $categorias = Categorias::all();
        $proveedores = Proveedores::all();
        $categoriaID = Categorias::findArray($producto->categoriaID);
        $proveedorID = Proveedores::findArray($producto->proveedorID);
        

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST['producto']['id'] = $producto->id;
            $_POST['producto']['image'] = $producto->image;
            $producto = new Productos($_POST['producto']);
            $errores = $producto->validar();

            $nombreImagen = md5( uniqid(rand(), true) ) .".jpg";

            if ($_FILES['producto']['tmp_name']['image']) {
                // Realiza un resize a la imagen con intervetion
                $image = Image::make($_FILES['producto']['tmp_name']['image'])->fit(800, 600);
                $producto->setImagen($nombreImagen);
            }

            if (empty($errores)) {
                if ($_FILES['producto']['tmp_name']['image']) {
                    // Almzacenar la imagen
                    $image->save(CARPETAS_IMAGENES .  $nombreImagen);
                }
                $producto->guardar();
            }
        }

        $router->render('productos/actualizar', [
            'id' => $id,
            'proveedores' => $proveedores,
            'categorias' => $categorias,
            'categoriaID' => $categoriaID,
            'proveedorID' => $proveedorID,
            'producto' => $producto
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