<?php
session_start();
require_once __DIR__ . '/controllers/SolicitudController.php';

$controller = new SolicitudController();
$controller->actualizar();