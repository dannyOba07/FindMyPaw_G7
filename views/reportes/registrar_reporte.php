<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Reporte - FindMyPaw</title>
    <link rel="stylesheet" href="./css/formulario_reportes.css">
</head>
<body>

    <div class="form-container">
        <h2>Registrar Reporte de Perro</h2>
        
        <form action="index.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="option" value="guardarReporte">
            
            <div class="form-group">
                <label>Tipo de Reporte:</label>
                <select name="tipoReporte" required>
                    <option value="1">Perdido</option>
                    <option value="2">Encontrado</option>
                    <option value="3">Abandonado</option>
                </select>
            </div>

            <div class="form-group">
                <label>Nombre del perro:</label>
                <input type="text" name="nombrePerro" required>
            </div>

            <div class="form-group">
                <label>Raza:</label>
                <input type="text" name="raza" required>
            </div>

            <div class="form-group">
                <label>Edad (años aprox.):</label>
                <input type="number" name="edad" required>
            </div>

            <div class="form-group">
                <label>Tamaño:</label>
                <select name="tamano">
                    <option value="Pequeño">Pequeño</option>
                    <option value="Mediano">Mediano</option>
                    <option value="Grande">Grande</option>
                </select>
            </div>

            <div class="form-group">
                <label>Color:</label>
                <input type="text" name="color" required>
            </div>

            <div class="form-group">
                <label>Sexo:</label>
                <select name="sexo">
                    <option value="Macho">Macho</option>
                    <option value="Hembra">Hembra</option>
                </select>
            </div>

            <div class="form-group">
                <label>Estado de salud:</label>
                <input type="text" name="estadoSalud" required>
            </div>

            <div class="form-group">
                <label>Ubicación:</label>
                <input type="text" name="ubicacion" required>
            </div>

            <div class="form-group">
                <label>Descripción:</label>
                <textarea name="descripcion" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label>Imagen del perro:</label>
                <input type="file" name="imagen" accept="image/*" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-guardar">Guardar Reporte</button>
                <a href="index.php?page=reportes" class="btn-volver">Volver</a>
            </div>

        </form>
    </div>

</body>
</html>