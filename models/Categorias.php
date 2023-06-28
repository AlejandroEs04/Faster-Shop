<?php

namespace Model;

class Categorias extends ActiveRecord {
    protected static $tabla = 'categorias';
    protected static $columnasDB = ['id', 'categoryName', 'image'];

    public $id;
    public $categoryName;
    public $image;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->categoryName = $args['categoryName'] ?? '';
        $this->image = $args['image'] ?? '';
    }

    // Valicacion
    public function validar() {
        if (!$this->categoryName) {
            self::$errores[] = "El nombre es obligatorio";
        }
        if (!$this->image) {
            self::$errores[] = "La imagen es obligatoria";
        }
        return self::$errores;
    }
}