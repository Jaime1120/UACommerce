<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Product.css">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <title>Productos más vendidos</title>
</head>
<body>
    <!-- Logos en contenedor separado con fondo blanco -->
    <div class="logo-container">
            <div class="logo-left">
            <a href="../index.php">
                <img src="../Recursos/LogoFacu.jpg" alt="Logo Facultad">
            </div>
            <div class="logo-right">
                <img src="../Recursos/Logouni.jpg" alt="Logo Página">
            </div>
        </div>

    <!-- Menú y opciones en contenedor azul -->
    <header class="header-container">
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
                    <a href="../controllers/login.php" class="icon"><i class='bx bx-user'></i></a>
                </div>
            <?php endif; ?>
        </div>
    </header>

    <!-- Lista de productos más vendidos -->
    <div class="products-list">
        <h2>Productos más vendidos</h2>
        <div id="product-list-container">
            <!-- Aquí se cargarán los productos dinámicamente -->
        </div>
    </div>

    <footer class="footer">
        <div class="container text-center">
            <span class="text-muted">UACommerce © <?php echo date('Y'); ?></span>
        </div>
    </footer>

    <script>
        // Llamada a la API para obtener los productos más vendidos
        fetch('http://localhost/UACommerce/APIs/top_products.php')
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('product-list-container');
                if (data && data.length > 0) {
                    data.forEach(product => {
                        // Crear una tarjeta para cada producto
                        const productCard = document.createElement('div');
                        productCard.className = 'product-card';

                        productCard.innerHTML = `
                            <img src="${product.imagen_url || 'Recursos/default.png'}" alt="Imagen del producto">
                            <h3>${product.nombre_producto}</h3>
                            <p><strong>Precio:</strong> $${product.precio}</p>
                            <p><strong>Vendidos:</strong> ${product.total_vendido}</p>
                        `;

                        container.appendChild(productCard);
                    });
                } else {
                    container.innerHTML = '<p>No se encontraron productos más vendidos.</p>';
                }
            })
            .catch(error => console.error('Error al obtener los productos:', error));
    </script>
</body>
</html>
