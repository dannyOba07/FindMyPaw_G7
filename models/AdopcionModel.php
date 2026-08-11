<?php
require_once __DIR__ . '/../config/database.php';

class AdopcionModel
{
    private PDO $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    // 1. Obtener perros en adopción con filtros opcionales
    public function obtenerPerrosAdopcion(?int $edadMax = null, ?string $ubicacion = null): array
    {
        $sql = "SELECT 
                    P.ID_PERRO,
                    P.NOMBRE_PERRO,
                    P.RAZA,
                    P.EDAD,
                    P.TAMANO,
                    P.COLOR,
                    P.SEXO,
                    P.DESCRIPCION,
                    R.UBICACION,
                    R.FECHA_REPORTE,
                    I.RUTA_IMAGEN
                FROM PERROS P
                INNER JOIN REPORTES R ON P.ID_PERRO = R.ID_PERRO
                LEFT JOIN IMAGENES_PERRO I ON P.ID_PERRO = I.ID_PERRO
                WHERE P.ID_ESTADO = 9"; // Estado 9 = En adopción

        $params = [];

        if (!empty($edadMax)) {
            $sql .= " AND P.EDAD <= :edadMax";
            $params[':edadMax'] = $edadMax;
        }

        if (!empty($ubicacion)) {
            $sql .= " AND R.UBICACION LIKE :ubicacion";
            $params[':ubicacion'] = "%" . $ubicacion . "%";
        }

        $sql .= " ORDER BY P.ID_PERRO DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    // 2. Registrar la solicitud de adopción en la BD
    public function guardarSolicitud(int $idUsuario, int $idPerro, string $comentario): bool
    {
        $sql = "INSERT INTO SOLICITUDES_ADOPCION (ID_USUARIO, ID_PERRO, ID_ESTADO, FECHA_SOLICITUD, COMENTARIO)
                VALUES (:id_usuario, :id_perro, 3, CURDATE(), :comentario)"; // Estado 3 = Pendiente

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id_usuario' => $idUsuario,
            ':id_perro' => $idPerro,
            ':comentario' => $comentario
        ]);
    }

    // 3. Obtener las solicitudes realizadas por un usuario específico
    public function obtenerSolicitudesPorUsuario(int $idUsuario): array
    {
        $sql = "SELECT 
                    S.ID_SOLICITUD,
                    S.FECHA_SOLICITUD,
                    S.COMENTARIO,
                    E.NOMBRE_ESTADO,
                    P.NOMBRE_PERRO,
                    P.RAZA,
                    I.RUTA_IMAGEN
                FROM SOLICITUDES_ADOPCION S
                INNER JOIN PERROS P ON S.ID_PERRO = P.ID_PERRO
                INNER JOIN ESTADOS E ON S.ID_ESTADO = E.ID_ESTADO
                LEFT JOIN IMAGENES_PERRO I ON P.ID_PERRO = I.ID_PERRO
                WHERE S.ID_USUARIO = :id_usuario
                ORDER BY S.ID_SOLICITUD DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_usuario' => $idUsuario]);

        return $stmt->fetchAll();
    }
}