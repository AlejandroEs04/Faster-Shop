<?php

namespace Controllers;

use Model\Categorias;
use Model\Productos;
use Controllers\UsuarioController;
use Model\Proveedores;
use MVC\Router;

class PaginasController {
    public static function index(Router $router) {
        $productosAll = Productos::all();
        $categorias = Categorias::all();
        $proveedores = Proveedores::all();

        $categoriasSlide = Categorias::get(8);

        foreach ($categoriasSlide as $categoria) {
            $categoria->productos = [
                $productos = Productos::where('categoriaID', $categoria->id),
            ];
        }

        $info = [
            'categorias' => $categorias,
            'proveedores' => $proveedores
        ];
        $categoriasSeccion = Categorias::get(6);

        if($_GET['category']) {
            $productosAll = Productos::where('categoriaID', $_GET['category']);
        }
        if($_GET['price']) {
            $productosAll = Productos::range('price', $_GET['price']);
        }
        

        $router->render('paginas/index', [
            'categoriasSlide' => $categoriasSlide,
            'categoriasSeccion' => $categoriasSeccion,
            'productosAll' => $productosAll,
            'categorias' => $categorias,
            'info' => $info
        ]);
    }

    public static function obtener(Router $router) {
        if(isset($_POST["estados"])){
            $estados = obtenerEstados();
             
            foreach($estados as $estado){
                echo "<option>". $estado['name'] . "</option>";
            }
        }

        if(isset($_POST["municipios"])){
            $municipios = $_POST["municipios"];

            $ciudades = obtenerCiudad($municipios);

            foreach($ciudades as $ciudad){
                echo "<option>". $ciudad['name'] . "</option>";
            }
        }
    }
}