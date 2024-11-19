<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../views/ProductosVendedor.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <title>Productos del Vendedor</title>
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

                <div class="user-options">
                    <a href="views/carritoView.php" class="icon"><i class='bx bx-cart'></i></a>

                    <?php if (isset($_SESSION['user_name'])): ?>
                        <div class="dropdown">
                            <p>Bienvenido(a), <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p>
                            <div class="dropdown-content">
                                <a href="/UACommerce/controllers/profile.php">Perfil</a>
                                <a href="settings.php">Configuración</a>
                                
                                <?php if ($_SESSION['user_type'] === 'vendedor'): ?>
                                    <a href="/UACommerce/controllers/ProductosVendedor.php">Mis Productos</a>
                                <?php endif; ?>

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
        


    <h2>Lista de productos:</h2>
    
    <!-- Botón para agregar un nuevo producto -->
    <button onclick="window.location.href='/UACommerce/vendedor/regProduct.php'" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">
        Nuevo Producto
    </button>

    <div class="product-container">
        <div id="product-car">
            <!-- Aquí se mostrarán los productos -->
        </div>
    
    </div>
    

    <script>
       // Obtener el ID del usuario desde la sesión
const idUsuario = <?php echo json_encode($_SESSION['user_id']); ?>;

// Construir la URL de la API
const apiUrl = `http://localhost/UACommerce/APIs/products_for_seller.php?id_usuario=${idUsuario}`;

// Realizar la solicitud a la API
fetch(apiUrl)
    .then(response => {
        if (!response.ok) {
            throw new Error(`Error en la API: ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {
        const productContainer = document.getElementById('product-car');

        // Verificar si hay productos en la respuesta
        if (data.length === 0) {
            productContainer.innerHTML = `<p>No hay productos disponibles.</p>`;
            return;
        }

        // Limpiar el contenedor antes de agregar los productos
        productContainer.innerHTML = '';

        // Iterar sobre los productos y crear las cartas
        data.forEach(producto => {
            const productCard = document.createElement('div');
            productCard.classList.add('product-card');

            // Crear la imagen del producto (o un placeholder si no hay imagen)
            const productImage = document.createElement('img');
            productImage.classList.add('product-image');
            productImage.src = producto.imagen_url || 'https://via.placeholder.com/200';
            productImage.alt = producto.nombre_producto;

            // Crear el contenedor de información del producto
            const productInfo = document.createElement('div');
            productInfo.classList.add('product-info');

            // Título del producto
            const productTitle = document.createElement('h3');
            productTitle.classList.add('product-title');
            productTitle.textContent = producto.nombre_producto;

            // Descripción del producto
            const productDescription = document.createElement('p');
            productDescription.classList.add('product-description');
            productDescription.textContent = producto.descripcion;

            // Precio del producto
            const productPrice = document.createElement('p');
            productPrice.textContent = `Precio: $${producto.precio}`;

            // Stock del producto
            const productStock = document.createElement('p');
            productStock.textContent = `Stock: ${producto.stock}`;

            // Botón para editar el producto
            const editButton = document.createElement('button');
            editButton.textContent = 'Editar';
            editButton.style.marginRight = '10px';
            editButton.onclick = () => {
                window.location.href = `/UACommerce/vendedor/editProduct.php?id_producto=${producto.id_producto}`;
            };

            // Botón para eliminar el producto
            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'Eliminar';
            deleteButton.onclick = () => {
                if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                    // Lógica para eliminar el producto (puedes agregar una solicitud a la API aquí)
                    console.log(`Producto con ID ${producto.id_producto} eliminado`);
                }
            };

            // Agregar elementos al contenedor de información
            productInfo.appendChild(productTitle);
            productInfo.appendChild(productDescription);
            productInfo.appendChild(productPrice);
            productInfo.appendChild(productStock);
            productInfo.appendChild(editButton);
            productInfo.appendChild(deleteButton);

            // Agregar la imagen y la información a la carta del producto
            productCard.appendChild(productImage);
            productCard.appendChild(productInfo);

            // Agregar la carta al contenedor principal
            productContainer.appendChild(productCard);
        });
    })
    .catch(error => {
        console.error('Error al obtener los datos:', error);
        document.getElementById('product-car').innerHTML = `<p>Error al obtener los datos.</p>`;
    });

    </script>
</body>
</html>
