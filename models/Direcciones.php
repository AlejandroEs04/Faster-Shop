<?php

namespace Model;

class Direcciones extends ActiveRecord {
    protected static $tabla = 'direcciones';
    protected static $columnasDB = ['id', 'nombreDireccion', 'calleNumero', 'colonia', 'cpp', 'numTelefono', 'pais', 'estado', 'ciudad', 'usuarioId'];

    public $id;
    public $nombreDireccion;
    public $calleNumero;
    public $colonia;
    public $cpp;
    public $numTelefono;
    public $pais;
    public $estado;
    public $ciudad;
    public $usuarioId;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombreDireccion = $args['nombreDireccion'] ?? '';
        $this->calleNumero = $args['calleNumero'] ?? '';
        $this->colonia = $args['colonia'] ?? '';
        $this->cpp = $args['cpp'] ?? '';
        $this->numTelefono = $args['numTelefono'] ?? '';
        $this->pais = $args['pais'] ?? 'Mexico';
        $this->estado = $args['estado'] ?? '';
        $this->ciudad = $args['ciudad'] ?? '';
        $this->usuarioId = $args['usuarioId'] ?? '';
    }

    public function validar() {
        if (!$this->nombreDireccion) {
            self::$errores[] = "La direccion es obligatoria";
        }
        if (!$this->calleNumero) {
            self::$errores[] = "La calle es obligatoria";
        }
        if (!$this->colonia) {
            self::$errores[] = "La colonia es obligatoria";
        }
        if (!$this->cpp) {
            self::$errores[] = "El Codigo Postal es obligatorio";
        }
        if (!$this->numTelefono) {
            self::$errores[] = "El numero de telefono es obligatorio";
        }
        return self::$errores;
    }
}