<?php

namespace Model;

class Usuarios extends ActiveRecord {
    /** Base de datos **/
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'name', 'email', 'password', 'number', 'address', 'confirmado', 'token', 'admin'];

    public $id;
    public $name;
    public $email;
    public $password;
    public $number;
    public $address;
    public $confirmado;
    public $token;
    public $admin;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->number = $args['number'] ?? '';
        $this->address = $args['address'] ?? '';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
        $this->admin = $args['admin'] ?? '0';
    }

    // Crear la validacion
    public function validarNuevaCuenta() {
        if (!$this->name) {
            self::$errores[] = "El nombre es obligatorio";
        }
        if (!$this->email) {
            self::$errores[] = "El correo es obligatorio";
        }
        if (!$this->password) {
            self::$errores[] = "La contrasena es obligatoria";
        }
        if (!$this->number) {
            self::$errores[] = "El numero es obligatorio";
        }
        return self::$errores;
    }

    public function validarLogin() {
        if (!$this->email) {
            self::$errores[] = "El correo es obligatorio";
        }
        if (!$this->password) {
            self::$errores[] = "La contrasena es obligatoria";
        }
        return self::$errores;
    }

    public function existeUsuario() {
        $query = " SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado->num_rows) {
            self::$errores['error'][] = "El usuario ya esta registrado";
        }

        return $resultado;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken() {
        $this->token = uniqid();
    }

    public function comprobarPasswordAndVerificado($password) {
        $resultado = password_verify($password, $this->password);

        if(!$resultado || !$this->confirmado) {
            self::$errores['error'][] = "Password incorrecto o tu cuenta no ha sido confirmada";
        } else {
            return true;
        }
    }
}