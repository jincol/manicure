<?php

namespace Controllers;

use Models\Servicios;
use MVC\Router;

class CitaController {

    public static function index(Router $router){
        session_start();
        
        isAuth();

        $router->render('/citas/index',[
            'auth' => $_SESSION['login'],
            'id' => $_SESSION['id'],
            'nombre' => $_SESSION['nombre']
        ]);
    }
    

}