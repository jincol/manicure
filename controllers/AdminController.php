<?php 

namespace Controllers;


use MVC\Router;
use Models\AdminCita;

class AdminController {

    public static function index (Router $router){
        session_start();

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fecha_get = explode('-', $fecha);
        $fecha_get = checkdate($fecha_get[1],$fecha_get[2],$fecha_get[0]);

        if(!$fecha_get){
            header('Location: /login');
        }

        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuario.nombre, ' ', usuario.apellido) as cliente, ";
        $consulta .= " usuario.email, usuario.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuario ";
        $consulta .= " ON citas.usuarioid=usuario.id  ";
        $consulta .= " LEFT OUTER JOIN citasservicios ";
        $consulta .= " ON citasservicios.citasid=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasservicios.serviciosid ";
        $consulta .= " WHERE fecha =  '$fecha' ";

        $citas = AdminCita::SQL($consulta);
        
        $router->render("/admin/index", [
            'auth' => $_SESSION['login'],
            'citas' => $citas,
         ]);    
    }
}