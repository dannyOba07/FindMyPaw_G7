<?php
require_once __DIR__ . '/../config/database.php';

class SolicitudModel
{
    private PDO $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function obtenerSolicitudesRefugio(int $idUsuario): array
    {
        $sql = "SELECT S.ID_SOLICITUD, S.ID_ESTADO, S.FECHA_SOLICITUD, S.COMENTARIO, U.ID_USUARIO, U.NOMBRE_USUARIO, U.APELLIDO_PATERNO, P.NOMBRE_PERRO, P.RAZA, E.NOMBRE_ESTADO
                FROM SOLICITUDES_ADOPCION S
                INNER JOIN USUARIOS U ON S.ID_USUARIO = U.ID_USUARIO
                INNER JOIN PERROS P ON S.ID_PERRO = P.ID_PERRO
                INNER JOIN ESTADOS E ON S.ID_ESTADO = E.ID_ESTADO
                INNER JOIN REFUGIOS R ON P.ID_REFUGIO = R.ID_REFUGIO
                WHERE R.ID_USUARIO = :id_usuario
                ORDER BY S.ID_SOLICITUD DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_usuario' => $idUsuario]);
        return $stmt->fetchAll();
    }

    public function obtenerSolicitudRefugio(int $idSolicitud, int $idUsuario)
    {
        $sql = "SELECT S.ID_SOLICITUD, S.ID_USUARIO, P.NOMBRE_PERRO
                FROM SOLICITUDES_ADOPCION S
                INNER JOIN PERROS P ON S.ID_PERRO = P.ID_PERRO
                INNER JOIN REFUGIOS R ON P.ID_REFUGIO = R.ID_REFUGIO
                WHERE S.ID_SOLICITUD = :id_solicitud AND R.ID_USUARIO = :id_usuario";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_solicitud' => $idSolicitud, ':id_usuario' => $idUsuario]);
        return $stmt->fetch();
    }

    public function actualizarEstado(int $idSolicitud, int $idEstado): bool
    {
        $sql = "UPDATE SOLICITUDES_ADOPCION SET ID_ESTADO = :id_estado WHERE ID_SOLICITUD = :id_solicitud";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id_estado' => $idEstado, ':id_solicitud' => $idSolicitud]);
    }

    public function guardarNotificacion(int $idUsuario, int $idSolicitud, int $idEstado, string $mensaje): bool
    {
        $sql = "INSERT INTO NOTIFICACIONES (ID_USUARIO, ID_REPORTE, ID_SOLICITUD, ID_ESTADO, MENSAJE, FECHA_NOTIFICACION)
                VALUES (:id_usuario, NULL, :id_solicitud, :id_estado, :mensaje, CURDATE())";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id_usuario' => $idUsuario, ':id_solicitud' => $idSolicitud, ':id_estado' => $idEstado, ':mensaje' => $mensaje]);
    }
}