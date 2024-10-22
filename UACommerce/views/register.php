<?php require_once BASE_PATH . '/views/layouts/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
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
                                <input type="text" name="nombre" class="form-control" required 
                                    value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Apellidos:</label>
                                <input type="text" name="apellidos" class="form-control" required
                                    value="<?php echo isset($_POST['apellidos']) ? htmlspecialchars($_POST['apellidos']) : ''; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Correo Electrónico:</label>
                        <input type="email" name="correo_electronico" class="form-control" required
                            value="<?php echo isset($_POST['correo_electronico']) ? htmlspecialchars($_POST['correo_electronico']) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label>Contraseña:</label>
                        <input type="password" name="contrasena" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Dirección:</label>
                        <textarea name="direccion" class="form-control"><?php echo isset($_POST['direccion']) ? htmlspecialchars($_POST['direccion']) : ''; ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Teléfono:</label>
                                <input type="text" name="telefono" class="form-control"
                                    value="<?php echo isset($_POST['telefono']) ? htmlspecialchars($_POST['telefono']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tipo de Usuario:</label>
                                <select name="tipo_usuario" class="form-control">
                                    <option value="comprador" <?php echo (isset($_POST['tipo_usuario']) && $_POST['tipo_usuario'] == 'comprador') ? 'selected' : ''; ?>>Comprador</option>
                                    <option value="vendedor" <?php echo (isset($_POST['tipo_usuario']) && $_POST['tipo_usuario'] == 'vendedor') ? 'selected' : ''; ?>>Vendedor</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                        <a href="/UACommerce/index.php" class="btn btn-link">¿Ya tienes cuenta? Inicia sesión</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/views/layouts/footer.php'; ?>