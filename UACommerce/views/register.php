<?php require_once BASE_PATH . '/views/layouts/header.php'; ?>

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

        <form method="post" action="/UACommerce/index.php" class="needs-validation" novalidate>
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Apellidos:</label>
                <input type="text" name="apellidos" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Correo Electrónico:</label>
                <input type="email" name="correo_electronico" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Contraseña:</label>
                <input type="password" name="contrasena" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Dirección:</label>
                <textarea name="direccion" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Teléfono:</label>
                <input type="text" name="telefono" class="form-control">
            </div>
            <div class="form-group">
                <label>Tipo de Usuario:</label>
                <select name="tipo_usuario" class="form-control">
                    <option value="vendedor">Vendedor</option>
                    <option value="comprador">Comprador</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</div>

<?php require_once BASE_PATH . '/views/layouts/footer.php'; ?>