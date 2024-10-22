<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UACommerce - Sistema de Comercio</title>
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
                        <h2>Registro de Usuario</h2>
                    </div>
                    <div class="card-body">
                        <?php if(isset($message)): ?>
                            <div class="alert <?php echo $success ? 'alert-success' : 'alert-danger'; ?>">
                                <?php echo $message; ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="/UACommerce/register.php" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombre:</label>
                                        <input type="text" name="nombre" class="form-control" pattern="^[A-Za-zÀ-ÿ\s]+$" required
                                            value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>">
                                        <div class="invalid-feedback">El nombre solo debe contener letras y espacios.</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Apellidos:</label>
                                        <input type="text" name="apellidos" class="form-control" pattern="^[A-Za-zÀ-ÿ\s]+$" required
                                            value="<?php echo isset($_POST['apellidos']) ? htmlspecialchars($_POST['apellidos']) : ''; ?>">
                                        <div class="invalid-feedback">Los apellidos solo deben contener letras y espacios.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Correo Electrónico:</label>
                                <input type="email" name="correo_electronico" class="form-control" required
                                    value="<?php echo isset($_POST['correo_electronico']) ? htmlspecialchars($_POST['correo_electronico']) : ''; ?>">
                                <div class="invalid-feedback">Por favor ingrese un correo electrónico válido.</div>
                            </div>

                            <div class="form-group">
                                <label>Contraseña:</label>
                                <input type="password" name="contrasena" class="form-control" minlength="8" pattern="(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}" required>
                                <div class="invalid-feedback">
                                    La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula y un número.
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Dirección:</label>
                                <textarea name="direccion" class="form-control"><?php echo isset($_POST['direccion']) ? htmlspecialchars($_POST['direccion']) : ''; ?></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Teléfono:</label>
                                        <input type="tel" name="telefono" class="form-control" pattern="\d{10}"
                                            value="<?php echo isset($_POST['telefono']) ? htmlspecialchars($_POST['telefono']) : ''; ?>">
                                        <div class="invalid-feedback">El teléfono debe tener 10 dígitos numéricos.</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tipo de Usuario:</label>
                                        <select name="tipo_usuario" class="form-control" required>
                                            <option value="comprador" <?php echo (isset($_POST['tipo_usuario']) && $_POST['tipo_usuario'] == 'comprador') ? 'selected' : ''; ?>>Comprador</option>
                                            <option value="vendedor" <?php echo (isset($_POST['tipo_usuario']) && $_POST['tipo_usuario'] == 'vendedor') ? 'selected' : ''; ?>>Vendedor</option>
                                        </select>
                                        <div class="invalid-feedback">Por favor seleccione el tipo de usuario.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center">
    <button type="submit" class="btn btn-primary">Registrar</button>
</div>

                            <div>
                            <a href="/UACommerce/controllers/login.php" class="btn btn-link">¿Ya tienes cuenta? Inicia sesión</a>
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
