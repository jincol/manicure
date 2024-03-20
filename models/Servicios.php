<?php

namespace Models;

class Servicios extends ActiveRecord
{
    protected static $tabla = "servicios";
    protected static $columnaDB = ['id','nombre','precio'];

    public $id;
    public $nombre;
    public $precio;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }

    public function validarError()
    {

        if(!$this->nombre){
            self::$alertas['error'][]="El nombre es obligatorio";
        }
        if(!$this->precio){
            self::$alertas['error'][]="El precio es obligatorio";
        }
        return self::$alertas;
    }
}
