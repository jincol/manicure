<?php

namespace Controllers;

use MVC\Router;

class LayoutController
{

    public static function layout(Router $router)
    {   
        session_start();
        
        $auth = $_SESSION['login']??'';

       
        
        $router->render("/templates/page",[
            'auth' => $auth
        ]);
    }
}
