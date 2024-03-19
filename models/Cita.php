<?php

namespace Models;

class Cita extends ActiveRecord
{

    protected static $tabla = 'citas';
    protected static $columnaDB = ['id', 'fecha', 'hora', 'usuarioid'];

    public $id;
    public $fecha;
    public $hora;
    public $usuarioid;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->usuarioid = $args['usuarioid'] ?? '';
    }
}
