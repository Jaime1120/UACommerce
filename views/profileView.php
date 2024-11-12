<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="../views/profileView.css">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">

</head>
<body>

<header>
        <div class="logo-container">
            <div class="logo-left">
                <img src="../Recursos/LogoFacu.jpg" alt="Logo Facultad">
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
                    <li><a href="views/categorias.php">Categorías</a></li> <!--modificacion Oscar , añadí Categorias.php-->
                </ul>
            </nav>
            <div class="search-bar">
                <input type="text" placeholder="Buscar productos...">
                <button type="submit" class="search-button">
                    <i class='bx bx-search-alt-2'></i> <!-- Icono de lupa de Boxicons -->
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
                    <div class="form-group text-center">
                    <a href="controllers/login.php" class="icon"><i class='bx bx-user'></i></a>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </header>

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
        </div>
        <div class="profile-footer">
            © 2024 - Perfil de Usuario
        </div>
    </div>
</body>
</html>
