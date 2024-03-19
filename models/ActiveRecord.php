<?php

namespace Models;

class ActiveRecord
{
    protected static $db;

    protected static $tabla = "";
    protected static $alertas = [];
    protected static $columnaDB = [];

    #-------------------------------------------------------------------------
    public static function setDB($dataBase)
    {
        self::$db = $dataBase; //El valor de la base de datos le otorga a %¿$DB y nos da acceso
    }

    public static function setAlertas($tipo, $mensaje)
    {
        static::$alertas[$tipo][] = $mensaje;
    } //MODIFICA LA ALERTA

    public static function getAlertas()
    {
        return  static::$alertas;
    } //TRAE LA ALERTA

    public function validarError()
    {
        static::$alertas = [];
        return static::$alertas;
    } //DEVUELVE  LA ALERTA


    //CONSULTA Y SI HAY RESULTADOS LOS CREA EN OBJETOS 
    public static function consultaSQL($query)
    {
        $resultado = self::$db->query($query);

        $arregloObjects = [];

        while ($registro = $resultado->fetch_assoc()) {
            $arregloObjects[] = static::crearObjectos($registro);
        }
        $resultado->free();

        return $arregloObjects;
    }
    public static function crearObjectos($registro)
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    #SANITIZAMOS LOS ATRIBUTOS - PRIEMERO TRAEMOS TODO LOS DATOS#
    public function atributos()
    {
        $atributos = [];

        foreach (static::$columnaDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }

    #SANITIZAMOS LOS ATRIBUTOS TRAIDOS CON atributos()#
    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();

        $sanitizados = [];

        foreach ($atributos as $key => $valor) {
            $sanitizados[$key] = self::$db->escape_string($valor);
        }
        return $sanitizados;
    }

    //SINCRONIZAR CON NUEVOS DATOS INGRESADOS 
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    public function guardar()
    {
        $resultado = "";
        if (!is_null($this->id)) {
            $resultado = $this->actualizar();
        } else {
          
            $resultado = $this->crear();
        }

        return $resultado;
    }

    public function crear()
    {

        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= "') ";

        // Resultado de la consulta
        $resultado = self::$db->query($query);
        return [
            'resultado' =>  $resultado,
            'id' => self::$db->insert_id
        ];
    }

    public function actualizar()
    {
        $atributos = $this->sanitizarAtributos();
        $valores = [];

        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        // Consulta SQL
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .=  join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);

        return $resultado;
    }

    public function eliminar(){
        $query = "DELETE FROM ".static::$tabla." WHERE id=".self::$db->escape_string($this->id)." LIMIT 1";

        $resultado = self::$db->query($query);

        return $resultado;
    }

    public static function where($columna, $valor)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE " . $columna . "='" . $valor . "'";

        $resultado = self::consultaSQL($query);

        // return array_shift( $resultado ) ; Array_shift saca del array y devuelve el primer valor

        return array_shift($resultado);
    }
    
    public static function SQL($query) {
        $resultado = self::consultaSQL($query);
        return $resultado ;
    }
    
    public static function all(){
        $query = "SELECT * FROM ".static::$tabla ;

        $resultado = self::consultaSQL($query);

        return $resultado;
    }

    public static function find($id){
        $query = "SELECT * FROM ".static::$tabla . " WHERE id=".$id." LIMIT 1" ;

        $resultado = self::consultaSQL($query);

        return array_shift( $resultado ) ;
    }
}
