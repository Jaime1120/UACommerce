<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UACommerce</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        .product-card {
            cursor: pointer;
        }
    </style>
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
                    <li><a href="#">Categorías</a></li>
                </ul>
            </nav>
            <div class="search-bar">
                <input type="text" placeholder="Buscar productos...">
                <button type="submit">&#128269;</button> <!-- Icono de búsqueda -->
            </div>
            <div class="user-options">
                <a href="#"><img src="Recursos/Carrito.png" alt="Carrito"></a>
                <div class="form-group text-center">
                    <a href="controllers/login.php" class="btn btn-primary">
                        <img src="Recursos/usuario.png" alt="Usuario" style="width: 30px; height: 30px;">
                    </a>
                </div>

            </div>
        </div>
    </header>
    <!-- Sección de cartas de productos -->
    <div class="product-container">
        <div class="product-card" onclick="location.href='Product.php'">
            <img class="product-img" >
            <h3>Producto 1</h3>
            <p>$100.00</p>
            <p>Descripción breve del producto 1. Este es un gran producto.</p>
            <div class="card-buttons">
                <button class="add-to-cart">Agregar al carrito</button>
                <button class="remove-from-cart">Quitar del carrito</button>
            </div>
        </div>
    
    </div>

    <script src="productos.js"></script>
</body>
</html>