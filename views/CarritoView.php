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

        <main>
            <div class="carrito-container">
                <h1>Carrito de Compras</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí puedes mostrar los productos en el carrito -->
                    </tbody>
                </table>
            </div>
        </main>

    </body>
</html>