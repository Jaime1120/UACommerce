<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos del Vendedor</title>
</head>
<body>
    <h1>Bienvenido, <span id="userName"></span>.</h1>
    <h2>Lista de productos:</h2>
    
    <!-- Botón para agregar un nuevo producto -->
    <button onclick="window.location.href='/UACommerce/vendedor/regProduct.php'" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">
        Nuevo Producto
    </button>
    
    <div id="productos">
        <!-- Aquí se mostrarán los productos -->
    </div>

    <script>
        // Configurar el nombre del usuario desde la sesión (inyectado desde el servidor PHP)
        const userName = <?php echo json_encode($_SESSION['user_name']); ?>;
        document.getElementById('userName').innerText = userName;

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
                const productosDiv = document.getElementById('productos');

                if (data.error || data.message) {
                    productosDiv.innerHTML = `<p>${data.error || data.message}</p>`;
                } else {
                    // Mostrar los productos en formato JSON
                    productosDiv.innerHTML = `<pre>${JSON.stringify(data, null, 2)}</pre>`;
                }
            })
            .catch(error => {
                console.error('Error al obtener los datos:', error);
                document.getElementById('productos').innerHTML = `<p>Error al obtener los datos.</p>`;
            });
    </script>
</body>
</html>
