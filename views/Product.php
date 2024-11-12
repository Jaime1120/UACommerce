<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Product.css">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <title>Detalles del Producto</title>
</head>
<body>
    <!-- Logos en contenedor separado con fondo blanco -->
    <div class="logo-container">
        <div class="logo-left">
            <img src="../Recursos/LogoFacu.jpg" alt="Logo Izquierdo">
        </div>
        <div class="logo-right">
            <img src="../Recursos/Logouni.jpg" alt="Logo Derecho">
        </div>
    </div>

    <!-- Menú y opciones en contenedor azul -->
    <header class="header-container">
        <nav class="nav-menu">
            <ul>
                <li><a href="#">Lo más top</a></li>
                <li><a href="#">Mis compras</a></li>
                <li><a href="#">Categorías</a></li>
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
    </header>

    <!-- Asegúrate de que estos elementos existan en tu HTML -->
    <div class="product-container">
        <div class="product-image">
            <img src="" alt="Imagen del producto">
        </div>
        <div class="product-info">
            <h2 class="product-name"></h2>
            <div class="product-details">
                <p class="product-description-text"></p>
                <div class="product-id">
                    <span><strong>ID del Vendedor:</strong></span>
                    <span id="vendedor-id">[Vendedor ID]</span> <!-- Deja este campo vacío para completarlo más adelante -->
                </div>
                <div class="product-category">
                    <span><strong>Categoría:</strong></span>
                    <span id="categoria">[Categoría]</span> <!-- Deja este campo vacío para completarlo más adelante -->
                </div>
                <div class="price-info">
                    <span class="current-price"></span>
                </div>
                <p class="product-stock">Stock: <span class="stock-amount"></span></p>
                <div class="quantity-container">
                    <input type="number" value="1" min="1">
                    <button class="buy-now-btn">Comprar ahora</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de comentarios -->
    <div class="comments-section">
        <div class="add-comment">
            <h3>Agregar un comentario</h3>
            <textarea placeholder="Escribe tu comentario aquí..."></textarea>
            <button class="submit-comment-btn">Enviar</button>
        </div>
        <div class="comments-container">
            <h3>Comentarios</h3>
            <!-- Los comentarios se cargarán aquí -->
        </div>
    </div>

    <footer class="footer">
            <div class="container text-center">
                <span class="text-muted">UACommerce © <?php echo date('Y'); ?></span>
            </div>
    </footer>
</body>
</html>