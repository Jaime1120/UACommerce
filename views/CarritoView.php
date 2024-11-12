<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Carrito - UACommerce</title>
        <link rel="stylesheet" href="../styles.css">
        <link rel="stylesheet" href="carrito.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
        <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <div class="logo-container">
                <div class="logo-left">
                    <img src="Recursos/LogoFacu.jpg" alt="Logo Facultad">
                </div>
                <div class="logo-right">
                    <img src="Recursos/Logouni.jpg" alt="Logo Página">
                </div>
            </div>
            <div class="header-container">
                <nav class="nav-menu">
                    <ul>
                        <li><a href="#">Lo más top</a></li>
                        <li><a href="#">Historial</a></li>
                        <li><a href="views/categorias.php">Categorías</a></li>
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
                        <div class="form-group text-center">
                        <a href="controllers/login.php" class="icon"><i class='bx bx-user'></i></a>
                        </div>

                    <?php endif; ?>
                </div>
            </div>
        </header>

        <main>
        <div class="carrito-container">
            <div class="product-list">
                <h1>Carrito</h1>
                <ul>
                    <?php
                    if (isset($_SESSION['user_name']) && isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                        // Mostrar productos si el carrito no está vacío
                        foreach ($_SESSION['carrito'] as $producto) {
                            echo '<li>';
                            echo '<span class="product-name">' . $producto['name'] . '</span>';
                            echo '<span class="product-quantity">Cantidad: ' . $producto['quantity'] . '</span>';
                            echo '<span class="product-price">Precio: $' . $producto['price'] . '</span>';
                            echo '</li>';
                        }
                    } else {
                        // Mostrar mensaje si el carrito está vacío o el usuario no ha iniciado sesión
                        echo '<p>Inicia sesión para ver el contenido de tu carrito.</p>';
                    }
                    ?>
                </ul>
            </div>

            <div class="price-container">
                <h2>Total:</h2>
                <span id="total-amount"></span>
            </div>
        </div>
        </main>

    </body>
</html>