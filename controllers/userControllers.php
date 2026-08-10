<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/user.php';

class userController
{
    private user $model;

    public function __construct()
    {
        $database = new database();
        $this->model = new user($database->connect());
    }

    private function verifyPassword(string $plain, string $stored): bool
    {
        if (password_get_info($stored)['algo'] !== null) {
            return password_verify($plain, $stored);
        }
        return hash_equals($stored, $plain);
    }

    public function login(): void
    {
        $correo   = trim($_POST['correo'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = $this->model->login($correo);

        if ($user && $this->verifyPassword($password, $user['CONTRASENA'])) {
            $_SESSION['id']     = $user['ID_USUARIO'];
            $_SESSION['correo'] = $user['CORREO'];
            $_SESSION['id_rol'] = $user['ID_ROL'];
            echo json_encode(['response' => '00', 'message' => 'Login exitoso', 'id_rol' => $user['ID_ROL']]);
        } else {
            echo json_encode(['response' => '01', 'message' => 'Error de autenticación']);
        }
    }

    public function register(): void
    {
        $correo           = trim($_POST['correo'] ?? '');
        $password         = $_POST['password'] ?? '';
        $confirm          = $_POST['confirm_password'] ?? '';
        $idRol            = in_array((int) ($_POST['id_rol'] ?? 0), [1, 2]) ? (int) $_POST['id_rol'] : 1;
        $nombre           = trim($_POST['nombre'] ?? '');
        $apellidoPaterno  = trim($_POST['apellido_paterno'] ?? '');
        $apellidoMaterno  = trim($_POST['apellido_materno'] ?? '');
        $telefono         = trim($_POST['telefono'] ?? '');
        $direccion        = trim($_POST['direccion'] ?? '');

        if (empty($correo) || empty($password) || empty($nombre)) {
            echo json_encode(['response' => '01', 'message' => 'Correo, contraseña y nombre son obligatorios']);
            return;
        }

        if ($password !== $confirm) {
            echo json_encode(['response' => '02', 'message' => 'Las contraseñas no coinciden']);
            return;
        }

        if ($this->model->emailExists($correo)) {
            echo json_encode(['response' => '03', 'message' => 'El correo ya está registrado']);
            return;
        }

        $this->model->register($correo, $password, $idRol, $nombre, $apellidoPaterno, $apellidoMaterno, $telefono, $direccion);
        echo json_encode(['response' => '00', 'message' => 'Registro exitoso']);
    }

    public function logout(): void
    {
        session_destroy();
        echo json_encode(['response' => '00', 'message' => 'Sesión cerrada']);
    }

    public function profile(): void
    {
        if (!isset($_SESSION['id'])) {
            echo json_encode(['response' => '01', 'message' => 'No autenticado']);
            return;
        }
        $user = $this->model->getById($_SESSION['id']);
        echo json_encode(['response' => '00', 'user' => $user]);
    }

    public function updateProfile(): void
    {
        if (!isset($_SESSION['id'])) {
            echo json_encode(['response' => '01', 'message' => 'No autenticado']);
            return;
        }
        $nombre          = trim($_POST['nombre'] ?? '');
        $apellidoPaterno = trim($_POST['apellido_paterno'] ?? '');
        $apellidoMaterno = trim($_POST['apellido_materno'] ?? '');
        $telefono        = trim($_POST['telefono'] ?? '');
        $direccion       = trim($_POST['direccion'] ?? '');

        $ok = $this->model->updateProfile($_SESSION['id'], $nombre, $apellidoPaterno, $apellidoMaterno, $telefono, $direccion);
        echo json_encode($ok
            ? ['response' => '00', 'message' => 'Perfil actualizado']
            : ['response' => '99', 'message' => 'Error al actualizar']);
    }
}