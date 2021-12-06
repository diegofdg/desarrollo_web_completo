<?php

namespace App;

class Propiedad {
    protected static $db;
    protected static $columnasDB = ['id','titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];
    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    public function __construct($args = []) 
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? 1;
    }

    public function guardar() {

        if(!is_null($this->id)) {
            $this->actualizar();

        } else {
            $this->crear();

        }    
    }
    
    public function crear() {

        $atributos = $this->sanitizarAtributos();         

        $query = " INSERT INTO propiedades ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
        
        $resultado = self::$db->query($query);
        
        if($resultado) {
            header('Location: /admin?resultado=1');
        }
    } 

    public function actualizar() {
        
        $atributos = $this->sanitizarAtributos();            

        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = " UPDATE propiedades SET ";
        $query .= join(', ', $valores);
        $query .= "WHERE id = '" . self::$db->escape_string($this->id) . "' " ;
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);
        
        if($resultado) {
            header('Location: /admin?resultado=2');
        }
    }

    public static function setDB($database) {
        self::$db = $database;
    }

    public function eliminar() {
        $query = "DELETE FROM propiedades WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado) {
            $this->borrarImagen();
            header('Location: /admin?resultado=3');
        }
    }

    public function atributos() {
        $atributos = [];
        foreach(self::$columnasDB as $columna) {
            if($columna === 'id') {
                continue;
            }
            $atributos[$columna] = $this->$columna; 
        }
        return $atributos;
    }

    public function sanitizarAtributos() { 
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    } 

    public function setImagen($imagen) {
        if(!is_null($this->id)) {
            $this->borrarImagen();
        }

        if($imagen){
            $this->imagen = $imagen;
        }
    }

    public function borrarImagen() {
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    public static function getErrores() {
        return self::$errores;
    }

    public function validar() {
        if(!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }
        if(!$this->precio) {
            self::$errores[] = 'El Precio es Obligatorio';
        }

        if( strlen( $this->descripcion ) < 50 ) {
            self::$errores[] = 'La descripción es obligatoria y debe tener al menos 50 caracteres';
        }

        if(!$this->habitaciones) {
            self::$errores[] = 'El Número de habitaciones es obligatorio';
        }
        
        if(!$this->wc) {
            self::$errores[] = 'El Número de Baños es obligatorio';
        }

        if(!$this->estacionamiento) {
            self::$errores[] = 'El Número de lugares de Estacionamiento es obligatorio';
        }
        
        if(!$this->vendedorId) {
            self::$errores[] = 'Elige un vendedor';
        }      
        
        if(!$this->imagen ) {
            self::$errores[] = 'La Imagen es Obligatoria';
        }

        return self::$errores;
    }


    public static function all() {
        $query = "SELECT * FROM propiedades";
        
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function find($id) {
        $query = "SELECT * FROM propiedades WHERE id = ${id}";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    public static function consultarSQL($query) {
        $resultado = self::$db->query($query);

        $array = [];

        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        }
        
        $resultado->free();

        return $array;
    }

    protected static function crearObjeto($registro) {
        $objeto = new self;

        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }        
        return $objeto;
    }

    public function sincronizar( $args = [] ) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key ) && !is_null($value) ) {
                $this->$key = $value;
            }
        }
    }
}