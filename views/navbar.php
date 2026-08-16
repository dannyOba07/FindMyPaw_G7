<nav style="background:#333; padding:10px; color:#fff;">
    <a href="index.php?page=catalogo" style="color:#fff; margin-right:15px;">Catálogo</a>
    <a href="index.php?page=reportes" style="color:#fff; margin-right:15px;">Reportes</a>
    
    <?php if (isset($_SESSION['id'])): ?>
        <a href="index.php?page=mis_solicitudes" style="color:#fff; margin-right:15px;">Mis Solicitudes</a>
        <a href="index.php?page=profile" style="color:#fff; margin-right:15px;">Mi Perfil</a>
    <?php if (($_SESSION['id_rol'] ?? 0) == 2): ?>
        <a href="index.php?page=panel_refugio" style="color:#fff; margin-right:15px;">Panel de Refugio</a>
    <?php endif; ?>
        <a href="views/logout.php" style="color:#ff6b6b;">Cerrar Sesión</a>
    <?php else: ?>
        <a href="index.php?page=login" style="color:#fff; margin-right:15px;">Iniciar Sesión</a>
        <a href="index.php?page=showRegister" style="color:#fff;">Registrarse</a>
    <?php endif; ?>
</nav>