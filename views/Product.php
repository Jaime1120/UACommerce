<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Product.css">
    <title>Detalles del Producto</title>
</head>
<body>
    <!-- Logos en contenedor separado con fondo blanco -->
    <div class="logo-container">
        <div class="logo-left">
            <img src="Recursos/LogoFacu.jpg" alt="Logo Izquierdo">
        </div>
        <div class="logo-right">
            <img src="Recursos/Logouni.jpg" alt="Logo Derecho">
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
            <button type="submit">&#128269;</button> <!-- Icono de búsqueda -->
        </div>
    
        <div class="user-options">
            <a href="#"><img src="Recursos/carrito-de-compras.png" alt="Usuario"></a>
            <a href="#"><img src="Recursos/usuario.png" alt="Carrito"></a>
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

<script>
    // Función para cargar el JSON
    async function cargarProducto() {
        try {
            const response = await fetch('Product.json');
            const data = await response.json();
            const producto = data.producto;

            // Actualizar el contenido de la página con la información del producto
            document.querySelector('.product-name').textContent = producto.nombre;
            document.querySelector('.product-description-text').textContent = producto.descripcion;
            document.querySelector('.current-price').textContent = `$${producto.precio_actual.toFixed(2)}`;
            document.querySelector('.stock-amount').textContent = producto.stock;
            document.querySelector('.product-image img').src = producto.imagen;

            // Cargar comentarios
            const commentsContainer = document.querySelector('.comments-container');
            producto.comentarios.forEach(comentario => {
                const commentDiv = document.createElement('div');
                commentDiv.classList.add('comment');
                commentDiv.innerHTML = `<p><strong>${comentario.usuario}:</strong> ${comentario.texto}</p>`;
                commentsContainer.appendChild(commentDiv);
            });
        } catch (error) {
            console.error('Error al cargar el producto:', error);
        }
    }

    // Llamar a la función al cargar la página
    window.onload = cargarProducto;
</script>

    <footer>
        <!-- Aquí puedes agregar el contenido del pie de página si es necesario -->
    </footer>
</body>
</html>