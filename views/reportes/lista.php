<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reportes - FindMyPaw</title>

    <link rel="stylesheet" href="./css/lista_reportes.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>

    <!-- Menú de navegación común -->
    <?php include __DIR__ . '/../navbar.php'; ?>

    <div class="contenedor-reportes">

        <header>
            <h1>Reportes de Perros</h1>

            <p>
                Conoce los perros perdidos, encontrados o abandonados
            </p>
        </header>
        <div style="text-align: center; margin-bottom: 20px;">
            <a href="index.php?page=form_registrar_reporte" style="background: #28a745; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">
                + Registrar Nuevo Reporte
            </a>
        </div>

        <section class="grid-reportes">

            <?php if (empty($reportes)) { ?>

                <p style="text-align:center; width:100%;">No hay reportes registrados.</p>

            <?php } else { ?>

                <?php foreach ($reportes as $reporte) { ?>

                    <div class="card-reporte">

                        <?php if (!empty($reporte["RUTA_IMAGEN"])) { ?>

                            <img
                                src="./img/reportes/<?php echo htmlspecialchars(basename($reporte["RUTA_IMAGEN"])); ?>"
                                alt="Foto de <?php echo htmlspecialchars($reporte["NOMBRE_PERRO"]); ?>">

                        <?php } else { ?>

                            <img
                                src="./img/fondo.png"
                                alt="Sin fotografía">

                        <?php } ?>

                        <div class="info-reporte">

                            <h2>
                                <?php
                                if (!empty($reporte["NOMBRE_PERRO"])) {
                                    echo htmlspecialchars($reporte["NOMBRE_PERRO"]);
                                } else {
                                    echo "Sin nombre";
                                }
                                ?>
                            </h2>

                            <p>
                                <?php echo htmlspecialchars($reporte["NOMBRE_TIPO_REPORTE"]); ?>
                            </p>

                            <a
                                class="btn-ver-reporte"
                                href="index.php?page=ver_reporte&id=<?php echo $reporte["ID_REPORTE"]; ?>">

                                Ver reporte completo

                            </a>

                        </div>

                    </div>

                <?php } ?>

            <?php } ?>

        </section>

    </div>

    <!-- Scripts JS -->
    <script src="./js/reportes.js?v=<?php echo time(); ?>"></script>
</body>

</html>