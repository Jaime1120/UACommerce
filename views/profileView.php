<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="../views/profileView.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
</head>
<body>

<header>
<<<<<<< Updated upstream
        <div class="logo-container">
            <div class="logo-left">
            <a href="../index.php">
                <img src="../Recursos/LogoFacu.jpg" alt="Logo Facultad">
            </div>
            <div class="logo-right">
                <img src="../Recursos/Logouni.jpg" alt="Logo Página">
            </div>
=======
    <div class="logo-container">
        <div class="logo-left">
            <img src="../Recursos/LogoFacu.jpg" alt="Logo Facultad">
>>>>>>> Stashed changes
        </div>
        <div class="logo-right">
            <img src="../Recursos/Logouni.jpg" alt="Logo Página">
        </div>
    </div>
    <div class="header-container">
        <nav class="nav-menu">
            <ul>
                <li><a href="#">Lo más top</a></li>
                <li><a href="#">Mis compras</a></li>
                <li><a href="../views/CategoriasView.php">Categorías</a></li>
            </ul>
        </nav>
        <div class="search-bar">
            <input type="text" placeholder="Buscar productos...">
            <button type="submit" class="search-button">
                <i class='bx bx-search-alt-2'></i>
            </button>
        </div>
        <div class="user-options">
            <a href="#" class="icon"><i class='bx bx-cart'></i></a>
            <?php if (isset($_SESSION['user_name'])): ?>
                <div class="dropdown">
                    <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p>
                    <div class="dropdown-content">
                        <a href="/UACommerce/controllers/profile.php">Perfil</a>
                        <a href="settings.php">Configuración</a>
                        <a href="/UACommerce/logout.php" class="logout-button">Cerrar sesión</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="controllers/login.php" class="icon"><i class='bx bx-user'></i></a>
            <?php endif; ?>
        </div>
    </div>
</header>

<!-- Contenedor principal con un margen superior para separar del header -->
<div class="perfil-usuario">
    <div class="profile-container">
        <div class="profile-header">
            <h1>Perfil de Usuario</h1>
        </div>
        <div class="profile-content">
            <div class="profile-row">
                <label>ID Usuario:</label>
                <span class="value"><?= htmlspecialchars($userData['id_usuario']); ?></span>
            </div>
            <div class="profile-row">
                <label>Nombre:</label>
                <span class="value"><?= htmlspecialchars($userData['nombre']); ?></span>
            </div>
            <div class="profile-row">
                <label>Apellidos:</label>
                <span class="value"><?= htmlspecialchars($userData['apellidos']); ?></span>
            </div>
            <div class="profile-row">
                <label>Correo Electrónico:</label>
                <span class="value"><?= htmlspecialchars($userData['correo_electronico']); ?></span>
            </div>
            <div class="profile-row">
                <label>Contraseña:</label>
                <span class="value">*******</span>
            </div>
            <div class="profile-row">
                <label>Dirección:</label>
                <span class="value"><?= htmlspecialchars($userData['direccion']); ?></span>
            </div>
            <div class="profile-row">
                <label>Teléfono:</label>
                <span class="value"><?= htmlspecialchars($userData['telefono']); ?></span>
            </div>
            <div class="profile-row">
                <label>Tipo de Usuario:</label>
                <span class="value"><?= htmlspecialchars($userData['tipo_usuario']); ?></span>
            </div>
            <div class="profile-row">
                <label>Fecha de Registro:</label>
                <span class="value"><?= htmlspecialchars($userData['fecha_registro']); ?></span>
            </div>
            <!-- Botón de redirección -->
            <div class="button-container">
                <a href="URL_DE_LA_VISTA_DE_DESTINO" class="redirect-button">Ir a la siguiente vista</a>
            </div>
        </div>
    </div>
    </div>

    <footer class="footer">
            <div class="container text-center">
                <span class="text-muted">UACommerce © <?php echo date('Y'); ?></span>
            </div>
    </footer>

</body>
</html>
