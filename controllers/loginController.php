<?php

namespace Controllers;

use Email\Email;
use Models\Usuarios;
use MVC\Router;

class loginController
{

    public static function login(Router $router)
    {
        $alertas = Usuarios::getAlertas();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario = new Usuarios($_POST);

            $alertas = $usuario->validarlogin();

            if (empty($alertas)) {

                $userverificado = Usuarios::where("email", $usuario->email);

                if ($userverificado) {

                    $verficarPassword = $userverificado->VerificarPassword($usuario->contrasenia);

                    if ($verficarPassword) {
                        session_start();

                        $_SESSION['id'] = $userverificado->id;
                        $_SESSION['nombre'] = $userverificado->nombre . " " . $userverificado->apellido;
                        $_SESSION['email'] =  $userverificado->email;
                        $_SESSION['login'] =  true;

                        if ($userverificado->admin === "1") {
                            $_SESSION["admin"] = $userverificado->admin ?? null;
                            header('Location: /servicios');
                        } else {
                            header('Location: /citas');
                        }
                    }
                } else {
                    Usuarios::setAlertas("error", "El usuario no existe");
                }
            }
        }


        $alertas = Usuarios::getAlertas();


        $router->render("/acceso/login", [
            "alertas" => $alertas
        ]);
    }
    public static function logout(Router $router)
    {
        session_start();

        if ($_SESSION['login'] || $_SESSION['admin']) {
            $_SESSION = [];

            header("Location: /");
        }


        $router->render("/logout", []);
    }
    public static function crear(Router $router)
    {
        $usuario = new Usuarios;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $args = $_POST;

            $usuario = new $usuario($args);

            $alertas = $usuario->validarError();

            if (empty($alertas)) {
                $resultado = $usuario->VerificarExistencia();

                if ($resultado->num_rows) {
                    $alertas = Usuarios::getAlertas();
                } else {
                    $usuario->HassPassword();
                    $usuario->GenerarToken();

                    // ENVIAMOS EL EMAIL
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);

                    $email->EnviarConfirmacion();

                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }

        $router->render("/acceso/crear", [
            "usuario" => $usuario,
            "alertas" => $alertas
        ]);
    }
    public static function mensaje(Router $router)
    {
        $alertas = [];
        $router->render("/acceso/mensaje", [
            "alertas" => $alertas
        ]);
    }
    public static function confirmar(Router $router)
    {
        $token = $_GET['token'];

        $usuario = Usuarios::where("token", $token);

        if (!$usuario) {
            $alertas = Usuarios::setAlertas("error", "Token Invalido");
        } else {
            $usuario->token = "";
            $usuario->confirmado = 1;
            $usuario->guardar(); //NECESITA ACTUALIZAR
            $alertas = Usuarios::setAlertas("exito", "Cuenta Confirmada con exito");
        }

        $alertas = Usuarios::getAlertas();
        $router->render("/acceso/confirmar", [
            "alertas" => $alertas
        ]);
    }

    public static function recuperar(Router $router)
    {
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuarios($_POST);

            $alertas = $usuario->validaremail();

            if (empty($alertas)) {

                $usuario = Usuarios::where("email", $usuario->email);

                if ($usuario && $usuario->confirmado === "1") {
                    $usuario->GenerarToken();
                    $usuario->guardar();

                    //CREAMOS UN NUEVO OBJETO EMAIL
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    Usuarios::setAlertas("exito", "Revisa tu EMAIL y sigue las Instrucciones");
                } else {
                    Usuarios::setAlertas("error", "No existe el usuario con ese EMAIL");
                }
            }
        }
        $alertas = Usuarios::getAlertas();


        $router->render("/acceso/recuperar", [
            'alertas' => $alertas
        ]);
    }

    public static function view_recuperar(Router $router)
    {
        $token = s($_GET['token']);

        $alertas = [];
        $usuario = Usuarios::where("token", $token);

        if (!$usuario  || empty($usuario)) {
            Usuarios::setAlertas("error", "TOKEN INVALIDO");
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newcontrasenia = new Usuarios($_POST);
            $alertas = $newcontrasenia->validarcontrasenia();

            if (empty($alertas)) {

                $usuario->contrasenia = "";
                $usuario->contrasenia = $newcontrasenia->contrasenia;
                $usuario->HassPassword();
                $usuario->token = null;

                $resultado = $usuario->guardar();

                if ($resultado) {
                    header('Location: /login');
                }
            }
        }

        $alertas = Usuarios::getAlertas();

        $router->render("/acceso/view-recuperar", [
            "alertas" => $alertas,
            "usuario" => $usuario
        ]);
    }
}
