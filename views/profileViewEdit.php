<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="../views/profileViewEdit.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
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
                <li><a href="views/TopView.php">Lo más top</a></li>
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
    <div class="profile-content">
        <form method="POST" action="updateProfile.php"> <!-- Acción del formulario -->
            <div class="profile-row">
                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?= htmlspecialchars($userData['nombre']); ?>" required>
            </div>
            <div class="profile-row">
                <label>Apellidos:</label>
                <input type="text" name="apellidos" value="<?= htmlspecialchars($userData['apellidos']); ?>" required>
            </div>
            <div class="profile-row">
                <label>Dirección:</label>
                <input type="text" name="direccion" value="<?= htmlspecialchars($userData['direccion']); ?>" required>
            </div>
            <div class="profile-row">
                <label>Teléfono:</label>
                <input type="text" name="telefono" value="<?= htmlspecialchars($userData['telefono']); ?>" required>
            </div>
            <div class="profile-row">
                <label>Tipo de Usuario:</label>
                <select name="tipo_usuario" required>
                    <option value="comprador" <?= $userData['tipo_usuario'] === 'comprador' ? 'selected' : ''; ?>>Comprador</option>
                    <option value="vendedor" <?= $userData['tipo_usuario'] === 'vendedor' ? 'selected' : ''; ?>>Vendedor</option>
                    <!-- Agrega más opciones si es necesario -->
                </select>
            </div>
            <div class="button-container">
                <button type="submit" class="redirect-button">Guardar Cambios</button>
            </div>
        </form>
    </div>

    <footer class="footer">
            <div class="container text-center">
                <span class="text-muted">UACommerce © <?php echo date('Y'); ?></span>
            </div>
    </footer>

</body>
</html>