<?php 

namespace Model;

class Carrito extends ActiveRecord {
    protected static $tabla = 'carrito';
    protected static $columnasDB = ['id', 'usuarioId', 'productoId', 'cantidad', 'precio', 'fechaAgregado'];

    public $id;
    public $usuarioId;
    PUBLIC $productoId;
    public $cantidad;
    public $precio;
    public $fechaAgregado;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->usuarioId = $args['usuarioId'] ?? '';
        $this->productoId = $args['productoId'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->fechaAgregado = date('l jS \of F Y h:i:s A');
    }

    public function validar() {
        if(!$this->cantidad) {
            self::$errores[] = "La cantidad es obligatoria";
        }
        return self::$errores;
    }
}