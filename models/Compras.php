<?php
 
namespace Model;

class Compras extends ActiveRecord {
    protected static $tabla = 'compras';
    protected static $columnasDB = ['id', 'idUsuario', 'fechaHora', 'productoId'];

    public $id;
    public $idUsuario;
    public $fechaHora;
    public $productoId;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->idUsuario = $args['idUsuario'] ?? '';
        $this->fechaHora = date('l jS \of F Y h:i:s A');
        $this->productoId = $args['productoId'] ?? '';
    }
}