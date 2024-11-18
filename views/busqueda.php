<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UACommerce</title>
    <link rel="stylesheet" href="busqueda.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
</head>

<body>
    <header>    
        <div class="logo-container">
            <div class="logo-left">
            <a href="index.php">
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
                    <li><a href="views/categoriasView.php">Categorías</a></li>
                </ul>
            </nav>

            <div class="search-bar">
                <form action="views/busqueda.php" method="GET" class="search-bar">
                    <input 
                        type="text" 
                        name="query" 
                        placeholder="Buscar productos..." 
                        required>
                    <button type="submit" class="search-button">
                        <i class='bx bx-search-alt-2'></i>
                    </button>
                </form>
            </div>

            <div class="user-options">
                <a href="views/carritoView.php" class="icon"><i class='bx bx-cart'></i></a>

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
    
    <!-- Sección de cartas de productos -->
    <div class="product-container">
        <div class="product-card" onclick="location.href='Product.php'">
            
        </div>
    
    </div>

    <footer class="footer">
            <div class="container text-center">
                <span class="text-muted">UACommerce © <?php echo date('Y'); ?></span>
            </div>
    </footer>


    <script src="productosBuscados.js"></script>
</body>
</html>