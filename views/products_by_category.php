<?php
    // Incluimos el encabezado para la conexión y otros elementos necesarios
    include '../config/Database.php';

    // Verificar si se pasó el ID de la categoría en la URL
    if (!isset($_GET['category_id']) || empty($_GET['category_id'])) {
        echo "No se especificó una categoría.";
        exit;
    }

    $category_id = intval($_GET['category_id']);
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
                    </a>
                </div>
                <div class="logo-right">
                    <img src="../Recursos/Logouni.jpg" alt="Logo Página">
                </div>
            </div>
            
        <div class="header-container">
            <nav class="nav-menu">
                <ul>
                    <li><a href="TopView.php">Lo más top</a></li>
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

        </div>
    </header>

    <div class="container">
        <h1>Productos de la Categoría</h1>
        <div id="product-list">
            <!-- Los productos se cargarán aquí mediante JavaScript -->
        </div>
    </div>

    <script>
        // Obtener el ID de la categoría de la URL
        const categoryId = <?php echo $category_id; ?>;

        // Función para obtener productos de la API
        async function fetchProducts() {
            const response = await fetch(`../APIs/get_products_by_category.php?category_id=${categoryId}`);
            const data = await response.json();

            // Verificar si la respuesta es exitosa
            if (data.success) {
                // Mostrar los productos
                const productList = document.getElementById('product-list');
                productList.innerHTML = ''; // Limpiar contenido previo

                data.data.forEach(product => {
                    const productItem = document.createElement('div');
                    productItem.classList.add('product-item');
                    
                    productItem.innerHTML = `
                        <img src="${product.imagen_url}" alt="${product.nombre_producto}" class="product-image" />
                        <h3>${product.nombre_producto}</h3>
                        <p>${product.descripcion}</p>
                        <p><strong>Precio: $${product.precio}</strong></p>
                        <p><strong>Stock: ${product.stock}</strong></p>
                    `;

                    productList.appendChild(productItem);
                });
            } else {
                // Si no hay productos o hubo un error
                document.getElementById('product-list').innerHTML = `<p>${data.message}</p>`;
            }
        }

        // Llamar a la función para obtener los productos
        fetchProducts();
    </script>

    <footer class="footer">
            <div class="container text-center">
                <span class="text-muted">UACommerce © <?php echo date('Y'); ?></span>
            </div>
    </footer>
    
</body>
</html>
