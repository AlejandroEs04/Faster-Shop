<?php

namespace Model;

class Productos extends ActiveRecord {
    /** Base de datos **/
    protected static $tabla = 'productos';
    protected static $columnasDB = ['id', 'productName', 'description', 'price', 'inventory', 'image', 'categoriaID'];

    public $id;
    public $productName;
    public $description;
    public $price;
    public $inventory;
    public $image;
    public $categoriaID;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->productName = $args['productName'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->price = $args['price'] ?? '';
        $this->inventory = $args['inventory'] ?? '';
        $this->image = $args['image'] ?? '';
        $this->categoriaID = $args['categoriaID'] ?? '';
    }

    // Validacion
    public function validar() {
        if (!$this->productName) {
            self::$errores[] = "El nombre es obligatorio";
        }
        if (!$this->price) {
            self::$errores[] = "El precio es obligatorio";
        }
        if (!$this->description) {
            self::$errores[] = "La descripcion es obligatoria";
        }
        if (!$this->inventory) {
            self::$errores[] = "El inventario es obligatorio";
        }
        if (!$this->categoriaID) {
            self::$errores[] = "La categoria es obligatoria";
        }
        return self::$errores;
    }
}