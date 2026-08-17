<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Solicitudes - FindMyPaw</title>
    <link rel="stylesheet" href="/proyecto/FindMyPaw_G7/css/catalogo.css">
    <style>
        .tabla-solicitudes {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .tabla-solicitudes th, .tabla-solicitudes td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .estado-Pendiente { color: #d97706; font-weight: bold; }
        .estado-Aprobado { color: #16a34a; font-weight: bold; }
        .estado-Rechazado { color: #dc2626; font-weight: bold; }
    </style>
</head>
<body>
    <?php include __DIR__ . '/navbar.php'; ?>
    <div class="contenedor-catalogo">
        <header>
            <h1>Mis Solicitudes de Adopción</h1>
            <p>Consulta el estado de tus trámites</p>
        </header>

        <table class="tabla-solicitudes">
            <thead>
                <tr>
                    <th>Mascota</th>
                    <th>Fecha</th>
                    <th>Comentario</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($solicitudes)): ?>
                    <tr><td colspan="4" style="text-align:center;">No has realizado solicitudes aún.</td></tr>
                <?php else: ?>
                    <?php foreach ($solicitudes as $soli): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($soli['NOMBRE_PERRO']); ?> (<?php echo htmlspecialchars($soli['RAZA']); ?>)</td>
                            <td><?php echo $soli['FECHA_SOLICITUD']; ?></td>
                            <td><?php echo htmlspecialchars($soli['COMENTARIO']); ?></td>
                            <td class="estado-<?php echo $soli['NOMBRE_ESTADO']; ?>">
                                <?php echo htmlspecialchars($soli['NOMBRE_ESTADO']); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>