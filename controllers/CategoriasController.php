<?php

namespace Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use Model\Categorias;
use MVC\Router;

class CategoriasController {
    public static function crearCategoria(Router $router) {
        $categoria = new Categorias;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crear una nueva instancia 
            $categoria = new Categorias($_POST['category']);

            // Generar un nombre unico para la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';
            // Setear la imagen
            if($_FILES['category']['tmp_name']['image']) {
                // Realizar un resize a la imagen con intervention
                $image = Image::make($_FILES['category']['tmp_name']['image'])->fit(800, 800);
                $categoria->setImagen($nombreImagen);
            }

            $errores = $categoria->validar();

            // Revisar que el arreglo de errores este vacio
            if(empty($errores)) {
                // Crear la carpeta para subir imagenes
                if (!is_dir(CARPETAS_IMAGENES)) {
                    mkdir(CARPETAS_IMAGENES);
                }

                // Guarda la imagen en el servidor
                $image->save(CARPETAS_IMAGENES . $nombreImagen);

                // Guardar registro en la base de datos
                $categoria->guardar();
            }
        }

        $router->render('categorias/crear', [
            'categoria' => $categoria
        ]);
    }

    public static function actualizarCategoria(Router $router) {

        $id = validarORedireccionar('/admin');
        $categoria = Categorias::findArray($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST['category']['id'] = $_GET['id'];
            $_POST['category']['image'] = $categoria->image;
            $categoria = new Categorias($_POST['category']);

            // Subida de archivos
            // Generar un numero unico para la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if($_FILES['category']['tmp_name']['image']) {
                // Realiza un resize a la imagen con intervetion
                $image = Image::make($_FILES['category']['tmp_name']['image']) -> fit(800, 800);
                $categoria->setImagen($nombreImagen);
            }

            $errores = $categoria->validar();

            // Verificar si el arreglo de errores esta vacio 
            if(empty($errores)) {
                if($_FILES['category']['tmp_name']['image']) {
                    // Almacenar imagen
                    $image->save(CARPETAS_IMAGENES . $nombreImagen);
                }

                $categoria->guardar();
            }
        }

        $router->render('categorias/actualizar', [
            'categoria' => $categoria,
            'errores' => $errores
        ]);
    }

    public static function eliminar(Router $router) {
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {
            // Validar que el producto exista 
            $existe = Categorias::findArray($id);

            if(empty($existe)) {
                header('location: /admin');
            } else {
                $existe->eliminar();
            }
        }
    }
}