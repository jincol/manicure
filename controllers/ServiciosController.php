<?php

namespace Controllers;

use Models\Servicios;
use MVC\Router;

class ServiciosController
{
    public static  function index(Router $router)
    {
        isAdmin();

        $admin = $_SESSION['admin']??'';

        $servicios = Servicios::all();

        $router->render("/servicios/index", [
            'auth' => $_SESSION['login'],
            'servicios' => $servicios,
            'admin'  => $admin       
         ]);
    }

    public static  function crear(Router $router)
    {
        echo "crear";
    }

    public static  function actualizar(Router $router)
    {
        isAdmin();

        $id = s($_GET['id']);

        if (!is_numeric($id)) {
            header('Location: /');
        }

        $servicios = Servicios::find($id);

        if ($servicios) {

            $alertas = Servicios::getAlertas();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $servicios->sincronizar($_POST);

                $alertas = $servicios->validarError();
                
                if (empty($alertas)) {
                    
                    $resultado= $servicios->guardar();
                    if($resultado){
                        header('Location: /servicios');
                    }
                    
                }
            }
        } else {
            debuguear('No se encontro el servicio');
        }


        $router->render("/servicios/actualizar", [
            'auth' => $_SESSION['login'],
            'servicios' => $servicios,
            'alertas' => $alertas
        ]);
    }

    public static  function eliminar(Router $router)
    {
        isAdmin();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $id = $_POST['id'];

            if(is_numeric($id)){
                $servicio = Servicios::find($_POST['id']);

                if(!$servicio) header('Location: /');

                $servicio->eliminar();

                header('Location: /servicios');
            }

            
        }

    }
}
