<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías - UACommerce</title>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <div class="logo-container">
            <div class="logo-left">
            <a href="../index.php">
                <img src="../Recursos/LogoFacu.jpg" alt="Logo Facultad">
            </div>
            <div class="logo-right">
                <img src="../Recursos/Logouni.jpg" alt="Logo Página">
            </div>
        </div>
            
        <div class="header-container">
            <nav class="nav-menu">
                <ul>
                    <li><a href="../views/TopView.php">Lo más top</a></li>
                    <li><a href="../views/MisComprasView.php">Mis compras</a></li>
                    <li><a href="../views/categoriasView.php">Categorías</a></li>
                </ul>
            </nav>
            <div class="search-bar">    
                <input type="text" placeholder="Buscar productos...">
                <button type="submit" class="search-button">
                    <i class='bx bx-search-alt-2'></i> <!-- Icono de lupa de Boxicons -->
                </button>
            </div>

            <div class="user-options">
                <a href="carritoView.php" class="icon"><i class='bx bx-cart'></i></a>

                <?php if (isset($_SESSION['user_name'])): ?>
                    <div class="dropdown">
                        <p>Bienvenido(a), <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p>
                        <div class="dropdown-content">
                            <a href="/../UACommerce/controllers/profile.php">Perfil</a>
                            <a href="settings.php">Configuración</a>
                            
                            <?php if ($_SESSION['user_type'] === 'vendedor'): ?>
                                <a href="/UACommerce/controllers/ProductosVendedor.php">Mis Productos</a>
                            <?php endif; ?>

                            <a href="/UACommerce/logout.php" class="logout-button">Cerrar sesión</a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="form-group text-center">
                        <a href="/../UACommerce/controllers/login.php" class="icon"><i class='bx bx-user'></i></a>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </header>

    <div class="product-container">
        <!-- Modificar las tarjetas para enviar el ID de la categoría -->
        <div class="product-card" onclick="location.href='products_by_category.php?category_id=1'">
            <img class="product-img" src="../Recursos/dulces.avif" alt="Producto 1">
            <h3>DULCES</h3>
            <p>Dulces, paletas y golocinas.</p>
        </div>

        <div class="product-card" onclick="location.href='products_by_category.php?category_id=2'">
            <img class="product-img" src="../Recursos/postres.jpg" alt="Producto 1">
            <h3>POSTRES</h3>
            <p>Postres de todo tipo, brownies, pasteles, muffins y reposteria.</p>
        </div>

        <div class="product-card" onclick="location.href='products_by_category.php?category_id=3'">
            <img class="product-img" src="../Recursos/bebidas.jpg" alt="Producto 1">
            <h3>BEBIDAS</h3>
            <p>Bebidas, jugos, aguas naturales, malteadas y más.</p>
        </div>

        <div class="product-card" onclick="location.href='products_by_category.php?category_id=4'">
            <img class="product-img" src="../Recursos/comida.jpg" alt="Producto 1">
            <h3>COMIDA</h3>
            <p>Servicio de alimentos, sandwiches, tortas y desayunos y almuerzos.</p>
        </div>

        <div class="product-card" onclick="location.href='products_by_category.php?category_id=5'">
            <img class="product-img" src="../Recursos/papeleria.jpg" alt="Producto 1">
            <h3>PAPELERIA</h3>
            <p>Hojas, impresiones, lápices, plumas y más.</p>
        </div>

        <div class="product-card" onclick="location.href='products_by_category.php?category_id=6'">
            <img class="product-img" src="../Recursos/bisuteria.jpg" alt="Producto 1">
            <h3>BISUTERIA</h3>
            <p>Pulseras, collares, stickers, aretes, colgantes y más.</p>
        </div>

        <div class="product-card" onclick="location.href='products_by_category.php?category_id=7'">
            <img class="product-img" src="../Recursos/servicios.jfif" alt="Producto 1">
            <h3>SERVICIOS</h3>
            <p>Prestación de servicios de todo tipo, impresiones, tenis, camisas y más.</p>
        </div>

        <div class="product-card" onclick="location.href='products_by_category.php?category_id=8'">
            <img class="product-img" src="../Recursos/libros.jpg" alt="Producto 1">
            <h3>LIBROS</h3>
            <p>Venta de libros, guías y enciclopedias.</p>
        </div>
    </div>

    <footer class="footer">
        <div class="container text-center">
            <span class="text-muted">UACommerce © <?php echo date('Y'); ?></span>
        </div>
    </footer>
</body>
</html>
