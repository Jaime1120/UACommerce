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
                        <h2>Iniciar Sesión</h2>
                    </div>
                    <div class="card-body">
                        <?php if(isset($message)): ?>
                            <div class="alert <?php echo $success ? 'alert-success' : 'alert-danger'; ?>">
                                <?php echo $message; ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" class="needs-validation" novalidate>
                            <div class="form-group">
                                <label>Correo Electrónico:</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Contraseña:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                        </form>

                        <div class="mt-3 text-center">
                            <p>¿No tienes una cuenta? <a href="/UACommerce/controllers/register.php">Regístrate aquí</a></p>
                        </div>
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
