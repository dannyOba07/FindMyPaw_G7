<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindMyPaw - Catálogo</title>
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="./css/catalogo.css?v=<?php echo time(); ?>">
    <!-- jQuery y Bootstrap CSS (opcional pero recomendado para el menú) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

    <!-- Menú de navegación común -->
    <?php include __DIR__ . '/navbar.php'; ?>

    <div class="contenedor-catalogo">
        
        <header>
            <h1>Catálogo de Adopciones</h1>
            <p>Encuentra a tu nuevo mejor amigo</p>
        </header>

        <form method="GET" action="index.php" id="filtros">
            <input type="hidden" name="page" value="catalogo">
            <h2>Filtrar Búsqueda</h2>
            <select name="edad" id="filtroEdad">
                <option value="">Todas las edades</option>
                <option value="1" <?php echo (isset($_GET['edad']) && $_GET['edad'] == '1') ? 'selected' : ''; ?>>Hasta 1 año</option>
                <option value="3" <?php echo (isset($_GET['edad']) && $_GET['edad'] == '3') ? 'selected' : ''; ?>>Hasta 3 años</option>
                <option value="5" <?php echo (isset($_GET['edad']) && $_GET['edad'] == '5') ? 'selected' : ''; ?>>Hasta 5 años</option>
            </select>

            <select name="ubicacion" id="filtroUbicacion">
                <option value="">Cualquier provincia</option>
                <option value="San José" <?php echo (isset($_GET['ubicacion']) && $_GET['ubicacion'] == 'San José') ? 'selected' : ''; ?>>San José</option>
                <option value="Heredia" <?php echo (isset($_GET['ubicacion']) && $_GET['ubicacion'] == 'Heredia') ? 'selected' : ''; ?>>Heredia</option>
                <option value="Alajuela" <?php echo (isset($_GET['ubicacion']) && $_GET['ubicacion'] == 'Alajuela') ? 'selected' : ''; ?>>Alajuela</option>
            </select>

            <button type="submit" id="btnFiltrar">Buscar</button>
        </form>

        <hr>

        <section id="gridCatalogo">
            <?php if (empty($perros)): ?>
                <p style="text-align:center; width:100%;">No hay perros disponibles con los filtros seleccionados.</p>
            <?php else: ?>
                <?php foreach ($perros as $perro): ?>
                    <div class="card-perro">
                        <img src="./<?php echo !empty($perro['RUTA_IMAGEN']) ? $perro['RUTA_IMAGEN'] : 'img/fondo.png'; ?>" alt="Foto de <?php echo $perro['NOMBRE_PERRO']; ?>">
                        <div class="info-perro">
                            <h3><?php echo htmlspecialchars($perro['NOMBRE_PERRO'] ?: 'Sin nombre'); ?></h3>
                            <p><strong>Raza:</strong> <?php echo htmlspecialchars($perro['RAZA']); ?></p>
                            <p><strong>Edad:</strong> <?php echo $perro['EDAD']; ?> años</p>
                            <p><strong>Ubicación:</strong> <?php echo htmlspecialchars($perro['UBICACION']); ?></p>
                        </div>
                        <button type="button" class="btnAdoptar" onclick="solicitarAdopcion(<?php echo $perro['ID_PERRO']; ?>, '<?php echo htmlspecialchars($perro['NOMBRE_PERRO']); ?>')">Solicitar Adopción</button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>

    </div>

    <!-- Scripts JS -->
    <script src="./js/auth.js?v=<?php echo time(); ?>"></script>
    <script src="./js/catalogo.js?v=<?php echo time(); ?>"></script>
</body>
</html>