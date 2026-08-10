<?php
class user
{
    private PDO $conn;
    private string $table = "USUARIOS";

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function login(string $correo)
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE CORREO = :correo LIMIT 1");
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    public function emailExists(string $correo): bool
    {
        $stmt = $this->conn->prepare("SELECT ID_USUARIO FROM {$this->table} WHERE CORREO = :correo LIMIT 1");
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        return (bool) $stmt->fetch();
    }

    public function register(
        string $correo, string $password, int $idRol, string $nombre, string $apellidoPaterno,
        string $apellidoMaterno, string $telefono, string $direccion
    ): bool {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare(
            "INSERT INTO {$this->table}
                (ID_ROL, ID_ESTADO, CORREO, CONTRASENA, NOMBRE_USUARIO, APELLIDO_PATERNO, APELLIDO_MATERNO, TELEFONO, DIRECCION)
             VALUES
                (:id_rol, 1, :correo, :contrasena, :nombre, :apellido_paterno, :apellido_materno, :telefono, :direccion)"
        );
        $stmt->bindParam(':id_rol', $idRol, PDO::PARAM_INT);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contrasena', $hash);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido_paterno', $apellidoPaterno);
        $stmt->bindParam(':apellido_materno', $apellidoMaterno);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':direccion', $direccion);
        return $stmt->execute();
    }

    public function getById(int $id)
    {
        $stmt = $this->conn->prepare(
            "SELECT u.ID_USUARIO, u.CORREO, u.NOMBRE_USUARIO, u.APELLIDO_PATERNO, u.APELLIDO_MATERNO,
                    u.TELEFONO, u.DIRECCION, u.ID_ROL, r.NOMBRE_ROL
             FROM {$this->table} u
             JOIN ROLES r ON r.ID_ROL = u.ID_ROL
             WHERE u.ID_USUARIO = :id LIMIT 1"
        );
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function updateProfile(int $id, string $nombre, string $apellidoPaterno, string $apellidoMaterno, string $telefono, string $direccion): bool
    {
        $stmt = $this->conn->prepare(
            "UPDATE {$this->table}
             SET NOMBRE_USUARIO = :nombre, APELLIDO_PATERNO = :apellido_paterno, APELLIDO_MATERNO = :apellido_materno,
                 TELEFONO = :telefono, DIRECCION = :direccion
             WHERE ID_USUARIO = :id"
        );
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido_paterno', $apellidoPaterno);
        $stmt->bindParam(':apellido_materno', $apellidoMaterno);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}