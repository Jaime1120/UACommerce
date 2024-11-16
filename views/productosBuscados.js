// Obtener el parámetro 'query' de la URL
const urlParams = new URLSearchParams(window.location.search);
const query = urlParams.get('query'); // Obtiene el valor del parámetro 'query'

// Realiza el fetch solo si hay un valor en 'query'
if (query) {
    const nombreProducto = encodeURIComponent(query); // Codifica el nombre para evitar problemas con caracteres especiales

    fetch(`http://localhost/UACommerce/APIs/product_for_name.php?nombre=${nombreProducto}`)
        .then(response => response.json()) // Convierte la respuesta a JSON
        .then(product => {
            // Imprime el JSON en la consola
            console.log(product);

            const productContainer = document.querySelector('.product-container');
            productContainer.innerHTML = ''; // Limpia el contenedor de productos

            if (product && product.id_producto) {
                const productCard = document.createElement('div');
                productCard.classList.add('product-card');

                // Verificar si el producto tiene una URL de imagen, si no, usar 'default.jpg'
                const imagenUrl = product.imagen_url ? product.imagen_url : '../Recursos/default.png';

                productCard.innerHTML = `
                    <img class="product-img" src="${imagenUrl}" alt="${product.nombre_producto}">
                    <h3>${product.nombre_producto}</h3>
                    <p>$${product.precio}</p>
                    <p>${product.descripcion}</p>
                    <div class="card-buttons">
                        <button class="add-to-cart">Agregar al carrito</button>
                        <button class="remove-from-cart">Quitar del carrito</button>    
                    </div>
                `;

                // Agrega el evento de clic para redirigir a otra vista con el id_producto
                productCard.addEventListener('click', () => {
                    window.location.href = `/UACommerce/views/Product.php?id=${product.id_producto}`;
                });

                productContainer.appendChild(productCard);
            } else {
                // Manejar el caso en el que no se encuentra el producto
                productContainer.innerHTML = '<p>Producto no encontrado.</p>';
            }
        })
        .catch(error => console.error('Error al cargar el producto:', error));
} else {
    console.error('No se proporcionó el parámetro "query" en la URL.');
}
