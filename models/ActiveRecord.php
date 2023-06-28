<?php

namespace Model;

class ActiveRecord {
    // Base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    // Errores o validacion
    protected static $errores = [];

    /** DEFINIT LA CONEXION A LA BASE DE DATOS **/
    public static function setDB($database) {
        self::$db = $database;
    }

    /** FUNCIONES EN LA BASE DE DATOS **/

    // Guardar elementos (crear o actualizar segun el id)
    public function guardar() {
        if(!is_null($this->id)) {
            // Si un elemento tiene un id, se actualizara
            $resultado = $this->actualizar();
        } else {
            // Si no tiene un id, se creara un nuevo registro
            $resultado = $this->crear();
        }
        return $resultado;
    }

    // Crear un nuevo registro
    public function crear() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar un registro a la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "') ";

        $resultado = self::$db->query($query);

        return [
            'resultado' =>  $resultado,
            'id' => self::$db->insert_id
        ];
    }

    // Actualizar un nuevo registro
    public function actualizar() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1";

        $resultado = self::$db->query($query);

        return $resultado;
    }

    // Eliminar un nuevo registro
    public function eliminar() {
        // Eliminar archivo
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if ($resultado) {
            #$this->borrarImagen();
            header('location: /admin');
        }
    }

    /** CONSULTAR A LA BASE DE DATOS **/

    // Lista todas las 
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Obtiene determinado numero de registros
    public static function get($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Busca una propiedad por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function findArray($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    // Busca un registro por su id y columna
    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE ${columna} = '${valor}'";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Busca un registro por su id
    public static function whereArray($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE ${columna} = '${valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado =  self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value) {
            if ( property_exists( $objeto, $key ) ) {
                $objeto->$key = $value;
            }
        } 

        return $objeto;
    }

    /** ATRIBUTOS **/
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }

    // Sanitizar los atributos
    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar( $args = [] ) {
        foreach($args as $key => $value) {
            if (property_exists( $this, $key ) && !is_null($value) ) {
                $this->$key = $value;
            }
        }
    }

    /** SUBIDA DE ARCHIVOS E IMAGENES */
    public function setImagen($imagen) {
        // Elimina imagen previa
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }

        // Asignar al atributo de imagen el nombre de la imagen
        if ($imagen) {
            $this->image = $imagen;
        }
    }

    // Eliminar archivo
    public function borrarImagen() {
        $existeArchivo =  file_exists(CARPETAS_IMAGENES . $this->imagen);

            if ($existeArchivo) {
                unlink(CARPETAS_IMAGENES . $this->imagen);
            }
    }

    /** VALIDACION **/
    public static function getErrores() {
        return static::$errores;
    }
    public static function setAlerta($tipo, $mensaje) {
        static::$errores[$tipo][] = $mensaje;
    }
    public static function getAlertas() {   
        return static::$errores;
    }

    public function validar() {
        static::$errores = [];
        return static::$errores;
    }
}