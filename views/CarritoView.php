<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Carrito - UACommerce</title>
        <link rel="stylesheet" href="../styles.css">
        <link rel="stylesheet" href="carrito.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
        <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    </head>
    <body>
        <header>
        <div class="logo-container">
            <div class="logo-left">
            <a href="../index.php">
                <img src="../Recursos/LogoFacu.jpg" alt="Logo Facultad">
            </div>
            <div class="logo-right">
                <img src="../Recursos/Logouni.jpg" alt="Logo Página">
            </div>
        </div>
            </div>
            <div class="header-container">
                <nav class="nav-menu">
                    <ul>
                        <li><a href="../views/TopView.php">Lo más top</a></li>
                        <li><a href="../views/MisComprasView.php">Mis compras</a></li>
                        <li><a href="../views/categoriasView.php">Categorías</a></li>
                    </ul>
                </nav>
                <div class="search-bar">
                    <input type="text" placeholder="Buscar productos...">
                    <button type="submit" class="search-button">
                        <i class='bx bx-search-alt-2'></i>
                    </button>
                </div>
                <div class="user-options">
                <a href="views/carritoView.php" class="icon"><i class='bx bx-cart'></i></a>

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
        <main>
            <div class="carrito-container">
                <div class="product-list">
                    <h1>Carrito</h1>
                    
                    <?php
                    // Mostrar notificación si hay mensaje de éxito o error
                    if (isset($_SESSION['success_message'])) {
                        echo "<script>alert('" . $_SESSION['success_message'] . "');</script>";
                        unset($_SESSION['success_message']); // Limpiar el mensaje después de mostrarlo
                    } elseif (isset($_SESSION['error_message'])) {
                        echo "<script>alert('" . $_SESSION['error_message'] . "');</script>";
                        unset($_SESSION['error_message']); // Limpiar el mensaje después de mostrarlo
                    }

                    if (isset($_SESSION['user_id'])) {
                        $user_id = $_SESSION['user_id']; // ID del usuario logueado
                        $api_url = "http://localhost/UACommerce/APIs/carrito.php?id_comprador=$user_id";
                        $response = file_get_contents($api_url);
                        $cart_items = json_decode($response, true);

                        if (isset($cart_items['message'])) {
                            echo "<p>{$cart_items['message']}</p>";
                        } else {
                            echo '<table border="1">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>';

                            $total = 0;
                            $itemcount = 0; // Cambiar esta variable para que sea consistente
                            foreach ($cart_items as $item) {
                                $subtotal = $item['precio_unitario'] * $item['cantidad'];
                                $total += $subtotal;
                                $itemcount++;

                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($item['nombre_producto']) . '</td>';
                                echo '<td>' . htmlspecialchars($item['cantidad']) . '</td>';
                                echo '<td>$' . number_format($item['precio_unitario'], 2) . '</td>';
                                echo '<td>$' . number_format($subtotal, 2) . '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody></table>';
                        }
                    } else {
                        // Si el usuario no está logueado, muestra el mensaje
                        echo '<p><a href="../controllers/login.php">Inicia sesión</a> para ver el contenido de tu carrito.</p>';
                    }
                    ?>
                </div>
                <div class="price-container">
                    <h2>Total:</h2>
                    <h2 id="total-amount"><?php echo isset($total) ? '$' . number_format($total, 2) : '$0.00'; ?></h2>

                    <?php if (isset($itemcount) && $itemcount > 0): ?> <!-- Cambia aquí la variable -->
                        <form action="../APIs/confirmar_compra.php" method="POST">
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                            <button type="submit" class="btn">Comprar</button>
                        </form>
                    <?php else: ?>
                        <p>Tu carrito está vacío</p>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </body>
</html>
