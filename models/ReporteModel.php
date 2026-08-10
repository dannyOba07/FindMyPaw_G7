<?php

require_once __DIR__ . '/../config/database.php';

class ReporteModel
{
    private PDO $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function guardarPerro(
        int $idUsuario,
        int $idEstado,
        string $nombrePerro,
        string $raza,
        int $edad,
        string $tamano,
        string $color,
        string $sexo,
        string $estadoSalud,
        string $descripcion
    ): int {

        $sql = "INSERT INTO PERROS
                (
                    ID_USUARIO,
                    ID_REFUGIO,
                    ID_ESTADO,
                    NOMBRE_PERRO,
                    RAZA,
                    EDAD,
                    TAMANO,
                    COLOR,
                    SEXO,
                    ESTADO_SALUD,
                    DESCRIPCION
                )
                VALUES
                (
                    :id_usuario,
                    NULL,
                    :id_estado,
                    :nombre_perro,
                    :raza,
                    :edad,
                    :tamano,
                    :color,
                    :sexo,
                    :estado_salud,
                    :descripcion
                )";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ":id_usuario" => $idUsuario,
            ":id_estado" => $idEstado,
            ":nombre_perro" => $nombrePerro,
            ":raza" => $raza,
            ":edad" => $edad,
            ":tamano" => $tamano,
            ":color" => $color,
            ":sexo" => $sexo,
            ":estado_salud" => $estadoSalud,
            ":descripcion" => $descripcion
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function guardarReporte(
        int $idUsuario,
        int $idPerro,
        int $idTipoReporte,
        int $idEstado,
        string $ubicacion,
        string $descripcion
    ): bool {

        $sql = "INSERT INTO REPORTES
                (
                    ID_USUARIO,
                    ID_PERRO,
                    ID_TIPO_REPORTE,
                    ID_ESTADO,
                    UBICACION,
                    FECHA_REPORTE,
                    DESCRIPCION
                )
                VALUES
                (
                    :id_usuario,
                    :id_perro,
                    :id_tipo_reporte,
                    :id_estado,
                    :ubicacion,
                    CURDATE(),
                    :descripcion
                )";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ":id_usuario" => $idUsuario,
            ":id_perro" => $idPerro,
            ":id_tipo_reporte" => $idTipoReporte,
            ":id_estado" => $idEstado,
            ":ubicacion" => $ubicacion,
            ":descripcion" => $descripcion
        ]);
    }

    public function guardarImagen(
    int $idPerro,
    string $rutaImagen,
    string $descripcion
): bool {

    $sql = "INSERT INTO IMAGENES_PERRO
            (
                ID_PERRO,
                ID_ESTADO,
                RUTA_IMAGEN,
                DESCRIPCION
            )
            VALUES
            (
                :id_perro,
                1,
                :ruta_imagen,
                :descripcion
            )";

    $stmt = $this->db->prepare($sql);

    return $stmt->execute([
        ":id_perro" => $idPerro,
        ":ruta_imagen" => $rutaImagen,
        ":descripcion" => $descripcion
    ]);
}

    public function obtenerReportes(): array
    {
        $sql = "SELECT
                    REPORTES.ID_REPORTE,
                    REPORTES.UBICACION,
                    REPORTES.FECHA_REPORTE,
                    REPORTES.DESCRIPCION,
                    PERROS.NOMBRE_PERRO,
                    PERROS.RAZA,
                    PERROS.EDAD,
                    PERROS.TAMANO,
                    PERROS.COLOR,
                    PERROS.SEXO,
                    PERROS.ESTADO_SALUD,
                    TIPO_REPORTES.NOMBRE_TIPO_REPORTE,
                    IMAGENES_PERRO.RUTA_IMAGEN
                FROM REPORTES
                INNER JOIN PERROS
                    ON REPORTES.ID_PERRO = PERROS.ID_PERRO
                INNER JOIN TIPO_REPORTES
                    ON REPORTES.ID_TIPO_REPORTE = TIPO_REPORTES.ID_TIPO_REPORTE
                LEFT JOIN IMAGENES_PERRO
                    ON PERROS.ID_PERRO = IMAGENES_PERRO.ID_PERRO
                ORDER BY REPORTES.ID_REPORTE DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}