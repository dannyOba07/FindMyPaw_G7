<?php
require_once __DIR__ . '/../models/SolicitudModel.php';

class SolicitudController
{
    private SolicitudModel $model;

    public function __construct()
    {
        $this->model = new SolicitudModel();
    }

    public function panel(): void
    {
        if (!isset($_SESSION['id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        if (($_SESSION['id_rol'] ?? 0) != 2) {
            header('Location: index.php?page=catalogo');
            exit;
        }

        $solicitudes = $this->model->obtenerSolicitudesRefugio((int)$_SESSION['id']);
        require_once __DIR__ . '/../views/panel_refugio.php';
    }

    public function actualizar(): void
    {
        if (!isset($_SESSION['id'])) {
            echo json_encode(['response' => '01', 'message' => 'Debe iniciar sesión']);
            return;
        }

        if (($_SESSION['id_rol'] ?? 0) != 2) {
            echo json_encode(['response' => '02', 'message' => 'No tiene permisos']);
            return;
        }

        $idSolicitud = (int)($_POST['id_solicitud'] ?? 0);
        $idEstado = (int)($_POST['id_estado'] ?? 0);

        if ($idSolicitud == 0 || !in_array($idEstado, [3, 4, 5])) {
            echo json_encode(['response' => '03', 'message' => 'Datos incorrectos']);
            return;
        }

        $solicitud = $this->model->obtenerSolicitudRefugio($idSolicitud, (int)$_SESSION['id']);

        if (!$solicitud) {
            echo json_encode(['response' => '04', 'message' => 'Solicitud no encontrada']);
            return;
        }

        $this->model->actualizarEstado($idSolicitud, $idEstado);

        if ($idEstado == 3) $mensaje = "Tu solicitud de adopción para " . $solicitud['NOMBRE_PERRO'] . " se encuentra pendiente.";
        if ($idEstado == 4) $mensaje = "Tu solicitud de adopción para " . $solicitud['NOMBRE_PERRO'] . " fue aprobada.";
        if ($idEstado == 5) $mensaje = "Tu solicitud de adopción para " . $solicitud['NOMBRE_PERRO'] . " fue rechazada.";

        $this->model->guardarNotificacion((int)$solicitud['ID_USUARIO'], $idSolicitud, $idEstado, $mensaje);
        echo json_encode(['response' => '00', 'message' => 'Estado actualizado correctamente']);
    }
}