<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Refugio - FindMyPaw</title>
    <link rel="stylesheet" href="./css/catalogo.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        .tabla-solicitudes { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .tabla-solicitudes th, .tabla-solicitudes td { padding: 12px; border: 1px solid #ddd; text-align: center; }
        .acciones button { margin: 3px; padding: 8px 12px; cursor: pointer; }
        .estado-Pendiente { color: #d97706; font-weight: bold; }
        .estado-Aprobado { color: #16a34a; font-weight: bold; }
        .estado-Rechazado { color: #dc2626; font-weight: bold; }
    </style>
</head>
<body>

    <?php include __DIR__ . '/navbar.php'; ?>

    <div class="contenedor-catalogo">
        <header>
            <h1>Panel de Refugio</h1>
            <p>Administración de solicitudes de adopción</p>
        </header>

        <table class="tabla-solicitudes">
            <thead>
                <tr>
                    <th>Solicitante</th>
                    <th>Perro</th>
                    <th>Raza</th>
                    <th>Fecha</th>
                    <th>Comentario</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($solicitudes)): ?>
                    <tr><td colspan="7">No hay solicitudes de adopción.</td></tr>
                <?php else: ?>
                    <?php foreach ($solicitudes as $solicitud): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($solicitud['NOMBRE_USUARIO'] . ' ' . $solicitud['APELLIDO_PATERNO']); ?></td>
                            <td><?php echo htmlspecialchars($solicitud['NOMBRE_PERRO']); ?></td>
                            <td><?php echo htmlspecialchars($solicitud['RAZA']); ?></td>
                            <td><?php echo $solicitud['FECHA_SOLICITUD']; ?></td>
                            <td><?php echo htmlspecialchars($solicitud['COMENTARIO']); ?></td>
                            <td class="estado-<?php echo $solicitud['NOMBRE_ESTADO']; ?>"><?php echo htmlspecialchars($solicitud['NOMBRE_ESTADO']); ?></td>
                            <td class="acciones">
                                <button onclick="cambiarEstado(<?php echo $solicitud['ID_SOLICITUD']; ?>, 4)">Aprobar</button>
                                <button onclick="cambiarEstado(<?php echo $solicitud['ID_SOLICITUD']; ?>, 5)">Rechazar</button>
                                <button onclick="cambiarEstado(<?php echo $solicitud['ID_SOLICITUD']; ?>, 3)">Pendiente</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="./js/panel_refugio.js"></script>
</body>
</html>