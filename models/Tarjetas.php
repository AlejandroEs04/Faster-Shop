<?php

namespace Model;

class Tarjetas extends ActiveRecord {
    protected static $tabla = 'tarjetas';
    protected static $columnasDB = ['id', 'usuarioId', 'tipo', 'numeroTarjeta', 'fechaVencimiento', 'nombreTarjeta', 'codigoCVV'];

    public $id;
    public $usuarioId;
    public $tipo;
    public $numeroTarjeta;
    public $fechaVencimiento;
    public $nombreTarjeta;
    public $codigoCVV;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->usuarioId = $args['usuarioId'] ?? '';
        $this->tipo = $args['tipo'] ?? '';
        $this->numeroTarjeta = $args['numeroTarjeta'] ?? '';
        $this->fechaVencimiento = $args['fechaVencimiento'] ?? '';
        $this->nombreTarjeta = $args['nombreTarjeta'] ?? '';
        $this->codigoCVV = $args['codigoCVV'] ?? '';
    }

    public function validar() {
        if (!$this->usuarioId) {
            self::$errores[] = "Hay un error, por favor, intentelo mas tarde";
        }
        if (!$this->tipo) {
            self::$errores[] = "Este campo es obligatorio";
        }
        if (!$this->numeroTarjeta) {
            self::$errores[] = "El numero de tarjeta es obligatorio";
        }
        if (!$this->fechaVencimiento) {
            self::$errores[] = "La fecha es obligatoria";
        }
        if (!$this->nombreTarjeta) {
            self::$errores[] = "El nombre es obligatorio";
        }
        if (!$this->codigoCVV) {
            self::$errores[] = "El codigo CVV es obligatorio";
        }
        return self::$errores;
    }
}