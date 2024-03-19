<?php

namespace Models;

class Usuarios extends ActiveRecord
{

    protected static $tabla = "usuario";

    protected static $columnaDB = ['id', 'nombre', 'apellido', 'email', 'contrasenia', 'telefono', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $contrasenia;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? "";
        $this->apellido = $args['apellido'] ?? "";
        $this->email = $args['email'] ?? "";
        $this->contrasenia = $args['contrasenia'] ?? "";
        $this->telefono = $args['telefono'] ?? "";
        $this->admin = $args['admin'] ?? 0;
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? "";
    }

    public function validarError()
    {

        if (!$this->nombre) {
            self::$alertas['error'][] = "El nombre debe ser obligatorio";
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = "El apellido debe ser obligatorio";
        }
        if (!$this->email) {
            self::$alertas['error'][] = "El email es importante y obligatorio";
        }
        if (!$this->contrasenia) {
            self::$alertas['error'][] = "La contrasenia debe ser unica";
        }
        if (!$this->telefono) {
            self::$alertas['error'][] = "El telefono debe ser obligatorio";
        }

        return self::$alertas;
    }

    public function validarlogin()
    {


        if (!$this->email) {
            self::$alertas['error'][] = "El email es importante y obligatorio";
        }
        if (!$this->contrasenia) {
            self::$alertas['error'][] = "La contrasenia debe ser unica";
        } else if (strlen($this->contrasenia) < 6) {
            self::$alertas["error"][] = "El password debe contener al menos 6 caracteres";
        }


        return self::$alertas;
    }
    public function validaremail()
    {
        if (!$this->email) {
            self::$alertas['error'][] = "El email es importante y obligatorio";
        }

        return self::$alertas;
    }
    public function validarcontrasenia()
    {
        if (!$this->contrasenia) {
            self::$alertas['error'][] = "La contrasenia debe ser unica";
        } else if (strlen($this->contrasenia) < 6) {
            self::$alertas["error"][] = "El password debe contener al menos 6 caracteres";
        }
        return self::$alertas;
    }

    public function VerificarPassword($contrasenia)
    {
        $pass = password_verify($contrasenia, $this->contrasenia);

        if (!$pass || !$this->confirmado) {
            self::$alertas['error'][] = "contrasenia Incorrecta o Cuenta no confirmada";
            
        } else {
            return true;
        }
    }

    public function VerificarExistencia()
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email ='" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if ($resultado->num_rows === 1) {
            self::$alertas['error'][] = "El usuario ya esta registrado ";
        }

        return $resultado;
    }

    public function HassPassword()
    {
        $this->contrasenia = password_hash($this->contrasenia, PASSWORD_BCRYPT);
    }

    public function GenerarToken()
    {
        return $this->token = uniqid();
    }
}
