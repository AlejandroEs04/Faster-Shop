<?php

namespace Model;

class Paypal extends ActiveRecord {
    protected static $tabla = 'paypal';
    protected static $columnasDB = ['id', 'idUsuario', 'email', 'token'];

    public $id;
    public $idUsuario;
    public $email;
    public $token;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->idUsuario = $args['idUsuario'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->token = $args['token'] ?? '';
    }

    public function validar() {
        if (!$this->email) {
            self::$errores[] = "El Email es obligatorio";
        }
        return self::$errores;
    }
}