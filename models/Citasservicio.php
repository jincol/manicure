<?php

namespace Models;

class Citasservicio extends ActiveRecord
{

    protected static $tabla = "citasservicios";
    protected static $columnaDB = ['id', 'serviciosid', 'citasid'];

    public $id;
    public $serviciosid;
    public $citasid;
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->serviciosid = $args['serviciosid'] ?? "";
        $this->citasid = $args['citasid'] ?? "";
    }
}
