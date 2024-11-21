<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis compras - UACommerce</title>
    <link rel="stylesheet" href="MisCompras.css">
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

    <main>
        <div class="orders-container">
            <h1>Mis compras</h1>

            <?php
            // Verificar si el usuario está autenticado
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];

                // Llamada a la API para recuperar los pedidos
                $api_url = "http://localhost/UACommerce/APIs/orders.php?id_comprador=$user_id";
                $response = file_get_contents($api_url);
                $orders = json_decode($response, true);

                if (isset($orders['message'])) {
                    echo "<p>{$orders['message']}</p>";
                } else if (empty($orders)) {
                    echo "<p>No tienes pedidos aún.</p>";
                } else {
                    echo '<table border="1" class="orders-table">
                        <thead>
                            <tr>
                                <th>ID Pedido</th>
                                <th>Fecha</th>
                                <th>Productos</th>
                                <th>Total</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>';

                    foreach ($orders as $order) {
                        $total = 0;

                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($order['id_pedido']) . '</td>';
                        echo '<td>' . htmlspecialchars($order['fecha_pedido']) . '</td>';
                        echo '<td>';

                        foreach ($order['productos'] as $producto) {
                            echo htmlspecialchars($producto['nombre_producto']) . ' (x' . $producto['cantidad'] . ')<br>';
                            $total += $producto['subtotal']; // Sumar el subtotal de cada producto
                        }

                        echo '</td>';
                        echo '<td>$' . number_format($total, 2) . '</td>';
                        echo '<td>' . htmlspecialchars($order['estado']) . '</td>';
                        echo '</tr>';
                    }

                    echo '</tbody></table>';
                }
            } else {
                echo '<p>Por favor, <a href="../controllers/login.php">inicia sesión</a> para ver tus pedidos.</p>';
            }
            ?>
        </div>
    </main>

    <footer class="footer">
        <div class="container text-center">
            <span class="text-muted">UACommerce © <?php echo date('Y'); ?></span>
        </div>
    </footer>
</body>
</html>
