<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UACommerce - Registro de Producto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { padding-top: 20px; }
        .container { max-width: 800px; }
        .alert { margin-top: 20px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/UACommerce">UACommerce</a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Registro de Producto</h2>
                    </div>
                    <div class="card-body">
                        <?php if(isset($message)): ?>
                            <div class="alert <?php echo $success ? 'alert-success' : 'alert-danger'; ?>">
                                <?php echo $message; ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="/UACommerce/controllers/register_product.php" class="needs-validation" novalidate>
                            <div class="form-group">
                                <label>Nombre del Producto:</label>
                                <input type="text" name="nombre_producto" class="form-control" required
                                    value="<?php echo isset($_POST['nombre_producto']) ? htmlspecialchars($_POST['nombre_producto']) : ''; ?>">
                                <div class="invalid-feedback">El nombre del producto es obligatorio.</div>
                            </div>

                            <div class="form-group">
                                <label>Descripción:</label>
                                <textarea name="descripcion" class="form-control" required><?php echo isset($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : ''; ?></textarea>
                                <div class="invalid-feedback">Por favor ingrese una descripción del producto.</div>
                            </div>

                            <div class="form-group">
                                <label>Precio (MXN):</label>
                                <input type="number" step="0.01" name="precio" class="form-control" required
                                    value="<?php echo isset($_POST['precio']) ? htmlspecialchars($_POST['precio']) : ''; ?>">
                                <div class="invalid-feedback">Por favor ingrese el precio del producto.</div>
                            </div>

                            <div class="form-group">
                                <label>Categoría:</label>
                                <select name="id_categoria" class="form-control" required>
                                    <option value="">Seleccione una categoría</option>
                                    <option value="1">Dulces</option>
                                    <option value="2">Postres</option>
                                    <option value="3">Bebidas</option>
                                    <option value="4">Comida</option>
                                    <option value="5">Papelería</option>
                                    <option value="6">Bisutería</option>
                                    <option value="7">Servicios</option>
                                    <option value="8">Libros</option>
                                </select>
                                <div class="invalid-feedback">Por favor seleccione una categoría.</div>
                            </div>

                            <div class="form-group">
                                <label>Cantidad en Stock:</label>
                                <input type="number" name="stock" class="form-control" required
                                    value="<?php echo isset($_POST['stock']) ? htmlspecialchars($_POST['stock']) : ''; ?>">
                                <div class="invalid-feedback">Por favor ingrese la cantidad en stock.</div>
                            </div>

                            <div class="form-group">
                                <label>URL de la Imagen:</label>
                                <input type="url" name="imagen_url" class="form-control" 
                                    value="<?php echo isset($_POST['imagen_url']) ? htmlspecialchars($_POST['imagen_url']) : ''; ?>">
                                <div class="invalid-feedback">Por favor ingrese una URL válida para la imagen.</div>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Registrar Producto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer mt-4 py-3 bg-light">
            <div class="container text-center">
                <span class="text-muted">UACommerce © <?php echo date('Y'); ?></span>
            </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </div>
</body>
</html>
