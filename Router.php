<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $funcion)
    {
        $this->getRoutes[$url] = $funcion;
    }

    public function post($url, $funcion)
    {
        $this->postRoutes[$url] = $funcion;
    }

    public function comprobarRutas()
    {
        // $currentUrl = $_SERVER['PATH_INFO'] ?? '/'; en localhost
        $currentUrl = strtok($_SERVER['REQUEST_URI'],'?') ?? '/'; //Corta la url desde "?" y retorna esa url
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == 'GET') {
            $ruta = $this->getRoutes[$currentUrl]?? '';
        } else {
            $ruta = $this->postRoutes[$currentUrl];
        }

        if ($ruta) {
            call_user_func($ruta, $this);
        } else {
            echo "No existe la pagina";
        }
    }

    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value;
        }

        ob_start(); //Almacena en memoria la vista por un momento
        include_once __DIR__."/views/$view.php";
        $contenido = ob_get_clean(); //limpia el bufer;
        include_once __DIR__."/views/layout.php";
    }
}
