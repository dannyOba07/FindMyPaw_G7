<?php

require_once __DIR__ . '/../models/ReporteModel.php';

class ReporteController
{
    private ReporteModel $model;

    public function __construct()
    {
        $this->model = new ReporteModel();
    }

    public function guardar(): void
    {
        $idUsuario = 1;

        $tipoReporte = $_POST["tipoReporte"] ?? "";
        $nombrePerro = $_POST["nombrePerro"] ?? "";
        $raza = $_POST["raza"] ?? "";
        $edad = $_POST["edad"] ?? "";
        $tamano = $_POST["tamano"] ?? "";
        $color = $_POST["color"] ?? "";
        $sexo = $_POST["sexo"] ?? "";
        $estadoSalud = $_POST["estadoSalud"] ?? "";
        $ubicacion = $_POST["ubicacion"] ?? "";
        $descripcion = $_POST["descripcion"] ?? "";

        if (
            $tipoReporte == "" ||
            $tamano == "" ||
            $color == "" ||
            $sexo == "" ||
            $estadoSalud == "" ||
            $ubicacion == "" ||
            $descripcion == ""
        ) {
            echo "Debe completar todos los campos obligatorios";
            return;
        }

        if ($tipoReporte == 1) {
            $idEstadoPerro = 7;
        } elseif ($tipoReporte == 2) {
            $idEstadoPerro = 8;
        } else {
            $idEstadoPerro = 9;
        }

        $idPerro = $this->model->guardarPerro(
            $idUsuario,
            $idEstadoPerro,
            $nombrePerro,
            $raza,
            (int)$edad,
            $tamano,
            $color,
            $sexo,
            $estadoSalud,
            $descripcion
        );

        if (isset($_FILES["imagen"]) && $_FILES["imagen"]["name"] != "") {

            $nombreImagen = $_FILES["imagen"]["name"];

            $rutaGuardar = __DIR__ . "/../img/reportes/" . $nombreImagen;

            move_uploaded_file(
                $_FILES["imagen"]["tmp_name"],
                $rutaGuardar
            );

            $rutaBaseDatos = "img/reportes/" . $nombreImagen;

            $this->model->guardarImagen(
                $idPerro,
                $rutaBaseDatos,
                "Fotografía de " . $nombrePerro
            );
        }

        $this->model->guardarReporte(
            $idUsuario,
            $idPerro,
            (int)$tipoReporte,
            1,
            $ubicacion,
            $descripcion
        );

        echo "Reporte registrado correctamente";
    }

    public function listar(): void
    {
        $reportes = $this->model->obtenerReportes();

        require __DIR__ . '/../views/reportes/lista.php';
    }

    public function verDetalle($id): void
    {
        $id = (int)$id;

        
        $reporte = $this->model->obtenerPorId($id);

        
        require_once __DIR__ . '/../views/reportes/detalle.php';
    }
}