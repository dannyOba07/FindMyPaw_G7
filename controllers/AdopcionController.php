<?php

require_once __DIR__ . '/../models/AdopcionModel.php';

class AdopcionController
{
    private AdopcionModel $model;

    public function __construct()
    {
        $this->model = new AdopcionModel();
    }

    // Renderiza o retorna el catálogo con/sin filtros
    public function listarCatalogo(): void
    {
        $edad = isset($_GET['edad']) && $_GET['edad'] !== '' ? (int)$_GET['edad'] : null;
        $ubicacion = $_GET['ubicacion'] ?? null;

        $perros = $this->model->obtenerPerrosAdopcion($edad, $ubicacion);

        require_once __DIR__ . '/../views/catalogo.php';
    }

    // Procesa el guardado AJAX de la solicitud
    public function guardarSolicitud(): void
{
    
    $idUsuario = $_SESSION['id'] ?? 1; 
    $idPerro = $_POST['id_perro'] ?? null;
    $comentario = trim($_POST['comentario'] ?? '');

    if (!is_numeric($idPerro) || empty($comentario)) {
        echo json_encode(['response' => '01', 'message' => 'Debe ingresar un comentario obligatorio.']);
        return;
    }

    $exito = $this->model->guardarSolicitud((int)$idUsuario, (int)$idPerro, $comentario);

    if ($exito) {
        echo json_encode(['response' => '00', 'message' => '¡Tu solicitud de adopción ha sido enviada con éxito!']);
    } else {
        echo json_encode(['response' => '99', 'message' => 'Ocurrió un error al registrar la solicitud.']);
    }
}

    // Muestra las solicitudes enviadas por el usuario logueado
    public function misSolicitudes(): void
    {
       
        $idUsuario = $_SESSION['id'] ?? 1;

        $solicitudes = $this->model->obtenerSolicitudesPorUsuario((int)$idUsuario);

        require_once __DIR__ . '/../views/mis_solicitudes.php';
    }
}