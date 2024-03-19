<?php

namespace Controllers;

use Models\Cita;
use Models\Citasservicio;
use Models\Servicios;

class ApiController
{

    //CONTIENE LOS SERVICIOS PERO EN FORMATO JSON
    //Se manipula en JS consultarApi()
    public static function index()
    {
        $servicios = Servicios::all();
        //DEVUELVE EN FORMATO JSON
        echo json_encode($servicios);
    }


    //RECIBIMOS LOS DATOS DE JS _> RESERVA CITA
    public static function guardar()
    {
        $cita = new Cita($_POST);

        // ALMACENA LA CITA Y RETORNA EL ID DE CITA
        $resultado = $cita->guardar();

        $id = $resultado['id'];

        $idServicios = explode(',', $_POST['servicios']);

        foreach ($idServicios as $idservicio) {
            $args = [
                'serviciosid' => $idservicio,
                'citasid' => $id
            ];

            $citaServicio = new Citasservicio($args);
            $r = $citaServicio->guardar();

            //     debuguear($r);

        }


        echo json_encode(["resultado" => $resultado]); //convierte en JSON

    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $id = filter_var($_POST['id'],FILTER_VALIDATE_INT);

           if(!$id){
            debuguear("Dato Corrompido!!!");
           }
           
           $cita = cita::find($id);

           $resultado = $cita->eliminar();

           if($resultado){
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
        
        }

    }
}
