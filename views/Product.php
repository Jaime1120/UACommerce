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
        <title>Detalles del Producto</title>
    </head>
    <body>
        <!-- Logos en contenedor separado con fondo blanco -->
        <div class="logo-container">
            <div class="logo-left">
                <a href="../index.php">
                    <img src="../Recursos/LogoFacu.jpg" alt="Logo Facultad">
                </a>
            </div>
            <div class="logo-right">
                <img src="../Recursos/Logouni.jpg" alt="Logo Página">
            </div>
        </div>

        <!-- Menú y opciones en contenedor azul -->
        <header class="header-container">
            <nav class="nav-menu">
                <ul>
                    <li><a href="views/TopView.php">Lo más top</a></li>
                    <li><a href="#">Mis compras</a></li>
                    <li><a href="categoriasView.php">Categorías</a></li>
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
        </header>

        <!-- Asegúrate de que estos elementos existan en tu HTML -->
        <div class="product-container">
            <div class="product-image">
                <img src="" alt="Imagen del producto" id="product-img">
            </div>
            <div class="product-info">
                <h2 class="product-name" id="product-name"></h2>
                <div class="product-details">
                    <p class="product-description-text" id="product-description"></p>
                    <div class="product-id">
                        <span><strong>ID del Vendedor:</strong></span>
                        <span id="vendedor-id"></span>
                    </div>
                    <div class="product-category">
                        <span><strong>Categoría:</strong></span>
                        <span id="category"></span>
                    </div>
                    <div class="price-info">
                        <span class="current-price" id="price"></span>
                    </div>
                    <p class="product-stock">Stock: <span id="stock"></span></p>
                    <div class="quantity-container">
                        <input type="number" id="quantity" value="1" min="1">
                        <button id="buy-now-btn" class="buy-now-btn">Comprar ahora</button>
                        <button id="add-to-cart-btn" class="buy-now-btn">Agregar al carrito</button>
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
                
            </div>
        </div>

        <footer class="footer">
            <div class="container text-center">
                <span class="text-muted">UACommerce © <?php echo date('Y'); ?></span>
            </div>
        </footer>

        <script>
            // Obtener el ID del producto de la URL
            const urlParams = new URLSearchParams(window.location.search);
            const productId = urlParams.get('id');

            // Verificar si se obtiene un ID válido
            if (productId) {
                fetch(`http://localhost/UACommerce/APIs/one_product.php?id=${productId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.id_producto) {
                            document.getElementById('product-img').src = data.imagen_url || 'Recursos/default.png';
                            document.getElementById('product-name').textContent = data.nombre_producto;
                            document.getElementById('product-description').textContent = data.descripcion;
                            document.getElementById('vendedor-id').textContent = data.id_vendedor;
                            document.getElementById('category').textContent = data.categoria || 'Sin categoría';
                            document.getElementById('price').textContent = `$${data.precio}`;
                            document.getElementById('stock').textContent = data.stock;
                        } else {
                            alert('Producto no encontrado');
                        }
                    })
                    .catch(error => console.error('Error al obtener los datos del producto:', error));
            } else {
                alert('ID de producto no válido');
            }

            // Agregar al carrito y redirigir a la vista del carrito
            document.getElementById('add-to-cart-btn').addEventListener('click', () => {
                const quantity = document.getElementById('quantity').value;
                const userId = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null'; ?>;

                if (!userId) {
                    alert('Por favor, inicia sesión para agregar productos al carrito.');
                    return;
                }

                if (quantity < 1) {
                    alert('La cantidad debe ser al menos 1.');
                    return;
                }

                const requestData = {
                    id_producto: productId,
                    id_comprador: userId,
                    cantidad: parseInt(quantity)
                };

                fetch('http://localhost/UACommerce/APIs/add_to_cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(requestData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Producto agregado al carrito con éxito');
                    } else {
                        alert(data.message || 'Error al agregar el producto al carrito.');
                    }
                })
                .catch(error => console.error('Error al agregar el producto al carrito:', error));
            });
            // Agregar al carrito y redirigir a la vista del carrito
            document.getElementById('buy-now-btn').addEventListener('click', () => {
                const quantity = document.getElementById('quantity').value;
                const userId = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null'; ?>;

                if (!userId) {
                    alert('Por favor, inicia sesión para agregar productos al carrito.');
                    return;
                }

                if (quantity < 1) {
                    alert('La cantidad debe ser al menos 1.');
                    return;
                }

                const requestData = {
                    id_producto: productId,
                    id_comprador: userId,
                    cantidad: parseInt(quantity)
                };

                fetch('http://localhost/UACommerce/APIs/add_to_cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(requestData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Producto agregado al carrito con éxito');
                        // Redirigir a la vista del carrito
                        window.location.href = 'http://localhost/UACommerce/views/carritoView.php';
                    } else {
                        alert(data.message || 'Error al agregar el producto al carrito.');
                    }
                })
                .catch(error => console.error('Error al agregar el producto al carrito:', error));
            });
        </script>
    </body>
</html>
