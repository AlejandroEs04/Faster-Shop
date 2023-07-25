<?php

namespace Model;

class Proveedores extends ActiveRecord {
    protected static $tabla = 'proveedores';
    protected static $columnasDB = ['id', 'proveedorName'];

    public $id;
    public $proveedorName;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->proveedorName = $args['proveedorName'] ?? '';
    }

    // Valicacion
    public function validar() {
        if (!$this->proveedorName) {
            self::$errores[] = "El nombre es obligatorio";
        }
        return self::$errores;
    }
}