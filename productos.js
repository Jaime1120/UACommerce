fetch('APIs/all_products.php')
  .then(response => response.json())
  .then(data => {
      const productContainer = document.querySelector('.product-container');
      productContainer.innerHTML = ''; // Limpia el contenedor de productos

      data.forEach(product => {
          const productCard = document.createElement('div');
          productCard.classList.add('product-card');

          // Agrega el id del producto como atributo de datos
          productCard.dataset.productId = product.id_producto;

          // Verificar si el producto tiene una URL de imagen, si no, usar 'default.jpg'
          const imagenUrl = product.imagen_url ? product.imagen_url : 'Recursos/default.png';

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
              window.location.href = `views/Product.php?id=${product.id_producto}`;
          });

          productContainer.appendChild(productCard);
      });
  })
  .catch(error => console.error('Error al cargar productos:', error));
