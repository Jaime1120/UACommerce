// Datos simulados para probar la carga de productos
const productosSimulados = [
    {
        id_producto: 1,
        nombre_producto: "Galletas de chispas de chocolate",
        descripcion: "Ricas y sabrosas galletas crujientes con chispas de chocolate.",
        precio: 20,
        imagen_url: "https://cdn7.kiwilimon.com/recetaimagen/31079/640x640/35433.jpg.webp" 
    },
    {
        id_producto: 2,
        nombre_producto: "Aguas frescas",
        descripcion: "tenemos de diversos sabores, ven a probarlas",
        precio: 25,
        imagen_url: "https://productosciervo.com.mx/wp-content/uploads/2021/03/9c57e5c564eb8b42764a377a14c1383f.jpg" 
    },
    {
        id_producto: 3,
        nombre_producto: "Panuchos de cochinita",
        descripcion: "Ricos y sabrosos panuchos de cochinita.",
        precio: 15,
        imagen_url: "https://revistacitylife.com/wp-content/uploads/2018/03/panuchos-pescado.jpg" 
    },
    {
        id_producto: 1,
        nombre_producto: "Galletas de chispas de chocolate",
        descripcion: "Ricas y sabrosas galletas crujientes con chispas de chocolate.",
        precio: 20,
        imagen_url: "https://m.media-amazon.com/images/I/616gyWldRTL._AC_SL1500_.jpg" 
    },
    {
        id_producto: 2,
        nombre_producto: "Aguas frescas",
        descripcion: "tenemos de diversos sabores, ven a probarlas",
        precio: 25,
        imagen_url: "https://productosciervo.com.mx/wp-content/uploads/2021/03/9c57e5c564eb8b42764a377a14c1383f.jpg" 
    },
    {
        id_producto: 3,
        nombre_producto: "Panuchos de cochinita",
        descripcion: "Ricos y sabrosos panuchos de cochinita.",
        precio: 15,
        imagen_url: "https://revistacitylife.com/wp-content/uploads/2018/03/panuchos-pescado.jpg" 
    },
    {
        id_producto: 1,
        nombre_producto: "Galletas de chispas de chocolate",
        descripcion: "Ricas y sabrosas galletas crujientes con chispas de chocolate.",
        precio: 20,
        imagen_url: "https://cdn7.kiwilimon.com/recetaimagen/31079/640x640/35433.jpg.webp" 
    }
];

// Función para cargar los productos simulados
function cargarProductos() {
    const contenedorProductos = document.querySelector('.product-container');
    contenedorProductos.innerHTML = ''; // Limpiamos el contenedor antes de agregar los productos

    productosSimulados.forEach(producto => {
        // Crea la tarjeta de producto
        const productoCard = document.createElement('div');
        productoCard.classList.add('product-card');

        // Agrega la imagen del producto
        const imagenProducto = document.createElement('img');
        imagenProducto.classList.add('product-img');
        imagenProducto.src = producto.imagen_url || '../Recursos/default.jpg'; // Usa una imagen predeterminada si no hay URL
        imagenProducto.alt = producto.nombre_producto;
        productoCard.appendChild(imagenProducto);

        // Agrega el nombre del producto
        const nombreProducto = document.createElement('h3');
        nombreProducto.textContent = producto.nombre_producto;
        productoCard.appendChild(nombreProducto);

        // Agrega el precio del producto
        const precioProducto = document.createElement('p');
        precioProducto.textContent = `$${producto.precio}`;
        productoCard.appendChild(precioProducto);

        // Agrega la descripción del producto
        const descripcionProducto = document.createElement('p');
        descripcionProducto.textContent = producto.descripcion;
        productoCard.appendChild(descripcionProducto);

        // Crear los botones de agregar y quitar del carrito
        const botonesDiv = document.createElement('div');
        botonesDiv.classList.add('card-buttons');

        const botonAgregar = document.createElement('button');
        botonAgregar.classList.add('add-to-cart');
        botonAgregar.textContent = 'Agregar al carrito';
        botonesDiv.appendChild(botonAgregar);

        const botonQuitar = document.createElement('button');
        botonQuitar.classList.add('remove-from-cart');
        botonQuitar.textContent = 'Quitar del carrito';
        botonesDiv.appendChild(botonQuitar);

        // Agregar los botones a la tarjeta del producto
        productoCard.appendChild(botonesDiv);

        // Agregar la tarjeta del producto al contenedor
        contenedorProductos.appendChild(productoCard);
    });
}

// Llamar a la función para cargar los productos al cargar la página
document.addEventListener('DOMContentLoaded', cargarProductos);
