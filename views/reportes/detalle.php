<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Reporte - FindMyPaw</title>
    <link rel="stylesheet" href="./css/lista_reportes.css?v=<?php echo time(); ?>">
</head>

<body>

    <?php include __DIR__ . '/../navbar.php'; ?>

    <div class="contenedor-reportes" style="margin-top: 30px;">
        <?php if (!empty($reporte)) { ?>

            <h1>Detalle del Reporte: <?php echo htmlspecialchars($reporte['NOMBRE_PERRO'] ?? 'Sin nombre'); ?></h1>

            <div style="display: flex; gap: 20px; background: white; padding: 20px; border-radius: 10px;">
                <div>
                    <img src="./img/reportes/<?php echo htmlspecialchars(basename($reporte['RUTA_IMAGEN'] ?? 'fondo.png')); ?>" 
                         alt="Foto" style="max-width: 300px; border-radius: 8px;">
                </div>
                <div>
                    <p><strong>Tipo:</strong> <?php echo htmlspecialchars($reporte['NOMBRE_TIPO_REPORTE'] ?? ''); ?></p>
                    <p><strong>Raza:</strong> <?php echo htmlspecialchars($reporte['RAZA'] ?? 'No especificada'); ?></p>
                    <p><strong>Edad:</strong> <?php echo htmlspecialchars($reporte['EDAD'] ?? ''); ?></p>
                    <p><strong>Tamaño:</strong> <?php echo htmlspecialchars($reporte['TAMANO'] ?? ''); ?></p>
                    <p><strong>Color:</strong> <?php echo htmlspecialchars($reporte['COLOR'] ?? ''); ?></p>
                    <p><strong>Ubicación:</strong> <?php echo htmlspecialchars($reporte['UBICACION'] ?? ''); ?></p>
                    <p><strong>Descripción:</strong> <?php echo htmlspecialchars($reporte['DESCRIPCION'] ?? ''); ?></p>
                    <br>
                    <a href="index.php?page=reportes" class="btn-ver-reporte">Volver a la lista</a>
                </div>
            </div>

        <?php } else { ?>
            <p>El reporte solicitado no existe.</p>
            <a href="index.php?page=reportes" class="btn-ver-reporte">Volver a la lista</a>
        <?php } ?>
    </div>

</body>

</html>