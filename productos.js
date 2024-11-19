let idComprador = null; // Inicializar como null

// Obtener el ID del comprador al cargar la página
fetch('APIs/get_user.php')
  .then(response => response.json())
  .then(data => {
      if (data.success) {
          idComprador = data.id_comprador;
      } else {
          console.error('Error al obtener el ID del comprador:', data.error);
      }
  })
  .catch(error => console.error('Error en la autenticación:', error));

fetch('APIs/all_products.php')
  .then(response => response.json())
  .then(data => {
      const productContainer = document.querySelector('.product-container');
      productContainer.innerHTML = ''; // Limpia el contenedor de productos

      data.forEach(product => {
          const productCard = document.createElement('div');
          productCard.classList.add('product-card');

          const imagenUrl = product.imagen_url ? product.imagen_url : 'Recursos/default.png';

          productCard.innerHTML = `
              <img class="product-img" src="${imagenUrl}" alt="${product.nombre_producto}">
              <h3>${product.nombre_producto}</h3>
              <p>$${product.precio}</p>
              <p>${product.descripcion}</p>
              <div class="card-buttons">
                  <button class="add-to-cart">Agregar al carrito</button>
                  <input type="number" class="quantity-input" value="1" min="1" style="width: 50px;">
              </div>
          `;

          // Evento para "Agregar al carrito"
          const addToCartButton = productCard.querySelector('.add-to-cart');
          const quantityInput = productCard.querySelector('.quantity-input');

          addToCartButton.addEventListener('click', (event) => {
              event.stopPropagation();

              if (!idComprador) {
                  alert('Debe iniciar sesión para agregar productos al carrito');
                  return;
              }

              const carritoData = {
                  id_comprador: idComprador,
                  id_producto: product.id_producto,
                  cantidad: parseInt(quantityInput.value, 10) || 1
              };

              fetch('APIs/add_to_cart.php', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json'
                  },
                  body: JSON.stringify(carritoData)
              })
              .then(response => response.json())
              .then(result => {
                  if (result.success) {
                      alert('Producto agregado al carrito');
                  } else {
                      alert(`Error: ${result.error}`);
                  }
              })
              .catch(error => {
                  console.error('Error al agregar al carrito:', error);
                  alert('Ocurrió un error al intentar agregar el producto al carrito.');
              });
          });

          productContainer.appendChild(productCard);
      });
  })
  .catch(error => console.error('Error al cargar productos:', error));
