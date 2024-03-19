<?Php

use Controllers\AdminController;
use Controllers\ApiController;
use Controllers\CitaController;
use MVC\Router;

require __DIR__ . '/../includes/app.php';

use Controllers\LayoutController;
use Controllers\loginController;
use Controllers\ServiciosController;


$router = new Router();

$router->get('/', [LayoutController::class, 'layout']);

//ACCESO
$router->get('/crear-cuenta', [loginController::class, 'crear']);
$router->post('/crear-cuenta', [loginController::class, 'crear']);
$router->get('/login', [loginController::class, 'login']);
$router->post('/login', [loginController::class, 'login']);
$router->get('/logout', [loginController::class, 'logout']);
$router->get('/mensaje', [loginController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [loginController::class, 'confirmar']);
$router->get('/recuperar', [loginController::class, 'recuperar']);
$router->post('/recuperar', [loginController::class, 'recuperar']);
$router->get('/view-recuperar', [loginController::class, 'view_recuperar']);
$router->post('/view-recuperar', [loginController::class, 'view_recuperar']);

//END POINT PARA SERVICIOS
$router->get('/servicios', [ServiciosController::class, 'index']);
$router->get('/servicios/crear', [ServiciosController::class, 'crear']);
$router->post('/servicios/crear', [ServiciosController::class, 'crear']);
$router->get('/servicios/actualizar', [ServiciosController::class, 'actualizar']);
$router->post('/servicios/actualizar', [ServiciosController::class, 'actualizar']);
$router->post('/servicios/eliminar', [ServiciosController::class, 'eliminar']);

//RUTAS PARA CITAS PRIVADA
$router->get('/citas', [CitaController::class, 'index']);
$router->get('/admin',[AdminController::class,'index']); //Muestra las citas para Admin


//RUTAS API
$router->get('/api/servicios',[ApiController::class,'index']);
$router->post('/api/citas',[ApiController::class,'guardar']);
$router->post('/api/eliminar',[ApiController::class,'eliminar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
