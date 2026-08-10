<?php

require_once __DIR__ . '/config/database.php';

$database = new Database();
$conexion = $database->connect();

echo "Conexión correcta a FINDMYPAW_DB";