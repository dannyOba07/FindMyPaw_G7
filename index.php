<?php
session_start();
// Ajustamos el nombre al archivo de tu controlador (normalmente en singular o plural según la estructura)
require_once __DIR__ . '/controllers/userControllers.php';

$page = $_GET['page'] ?? 'login';

// Procesamiento de peticiones GET / API
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['option'])) {
    $auth = new userController();
    $option = $_GET['option'];

    switch ($option) {
        case 'profile':
            $auth->profile();
            exit;
    }
}

// Procesamiento de peticiones POST (AJAX)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new userController();
    $option = $_POST['option'] ?? '';

    switch ($option) {
        
        case 'login':
            $auth->login();
            exit;
        case 'register':
            $auth->register();
            exit;
        case 'updateProfile':
            $auth->updateProfile();
            exit;
        case 'logout':
            $auth->logout();
            exit;
        case 'guardarSolicitud':
        require_once __DIR__ . '/controllers/AdopcionController.php';
        $controller = new AdopcionController();
        $controller->guardarSolicitud();
        exit;
        case 'actualizarEstadoSolicitud':
            require_once __DIR__ . '/controllers/SolicitudController.php';
            $controller = new SolicitudController();
            $controller->actualizar();
            exit;
    }
}

// Enrutamiento de vistas principales
switch ($page) {
    case 'catalogo':
        require_once __DIR__ . '/controllers/AdopcionController.php';
        $controller = new AdopcionController();
        $controller->listarCatalogo();
        break;

    case 'reportes':
        require_once __DIR__ . '/controllers/ReporteController.php';
        $controller = new ReporteController();
        $controller->listar();
        break;

    case 'ver_reporte':
        require_once __DIR__ . '/controllers/ReporteController.php';
        $controller = new ReporteController();
        // Llama al método encargado de mostrar el detalle pasando el ID
        if (method_exists($controller, 'verDetalle')) {
            $controller->verDetalle($_GET['id'] ?? 0);
        } else {
            $controller->listar(); // Respaldo si no existe el método
        }
        break;

    case 'mis_solicitudes':
        require_once __DIR__ . '/controllers/AdopcionController.php';
        $controller = new AdopcionController();
        $controller->misSolicitudes();
        break;

    case 'panel_refugio':
        require_once __DIR__ . '/controllers/SolicitudController.php';
        $controller = new SolicitudController();
        $controller->panel();
        break;

    case 'showRegister':
        require_once __DIR__ . '/views/register.php';
        break;

    case 'profile':
        include __DIR__ . '/views/profile.php';
        break;

    case 'login':
    default:
        require_once __DIR__ . '/views/login.php';
        break;
}