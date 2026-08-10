<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reportes - FindMyPaw</title>

    <link rel="stylesheet" href="css/reportes.css">
</head>

<body>

    <div class="contenedor-reportes">

        <header>
            <h1>Reportes de Perros</h1>

            <p>
                Conoce los perros perdidos, encontrados o abandonados
            </p>
        </header>

        <section class="grid-reportes">

            <?php if (count($reportes) == 0) { ?>

                <p>No hay reportes registrados.</p>

            <?php } else { ?>

                <?php foreach ($reportes as $reporte) { ?>

                    <div class="card-reporte">

                        <?php if ($reporte["RUTA_IMAGEN"] != "") { ?>

                            <img
                                src="<?php echo $reporte["RUTA_IMAGEN"]; ?>"
                                alt="Foto de <?php echo $reporte["NOMBRE_PERRO"]; ?>">

                        <?php } else { ?>

                            <img
                                src="img/fondo.png"
                                alt="Sin fotografía">

                        <?php } ?>

                        <div class="info-reporte">

                            <h2>
                                <?php
                                if ($reporte["NOMBRE_PERRO"] != "") {
                                    echo $reporte["NOMBRE_PERRO"];
                                } else {
                                    echo "Sin nombre";
                                }
                                ?>
                            </h2>

                            <p>
                                <?php echo $reporte["NOMBRE_TIPO_REPORTE"]; ?>
                            </p>

                            <a
                                class="btn-ver-reporte"
                                href="ver_reporte.php?id=<?php echo $reporte["ID_REPORTE"]; ?>">

                                Ver reporte completo

                            </a>

                        </div>

                    </div>

                <?php } ?>

            <?php } ?>

        </section>

    </div>

</body>

</html>