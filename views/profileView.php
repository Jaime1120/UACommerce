<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .profile-container {
            width: 350px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .profile-header {
            background-color: #4A90E2;
            padding: 20px;
            text-align: center;
            color: #ffffff;
        }
        .profile-header h1 {
            font-size: 24px;
            margin: 0;
        }
        .profile-content {
            padding: 20px;
        }
        .profile-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        .profile-row:last-child {
            border-bottom: none;
        }
        .profile-row label {
            font-weight: bold;
            color: #555;
        }
        .profile-row .value {
            color: #777;
        }
        .profile-footer {
            background-color: #f9fafb;
            padding: 15px;
            text-align: center;
            font-size: 14px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <h1>Perfil de Usuario</h1>
        </div>
        <div class="profile-content">
            <div class="profile-row">
                <label>ID Usuario:</label>
                <span class="value"><?= htmlspecialchars($userData['id_usuario']); ?></span>
            </div>
            <div class="profile-row">
                <label>Nombre:</label>
                <span class="value"><?= htmlspecialchars($userData['nombre']); ?></span>
            </div>
            <div class="profile-row">
                <label>Apellidos:</label>
                <span class="value"><?= htmlspecialchars($userData['apellidos']); ?></span>
            </div>
            <div class="profile-row">
                <label>Correo Electrónico:</label>
                <span class="value"><?= htmlspecialchars($userData['correo_electronico']); ?></span>
            </div>
            <div class="profile-row">
                <label>Contraseña:</label>
                <span class="value">********</span>
            </div>
            <div class="profile-row">
                <label>Dirección:</label>
                <span class="value"><?= htmlspecialchars($userData['direccion']); ?></span>
            </div>
            <div class="profile-row">
                <label>Teléfono:</label>
                <span class="value"><?= htmlspecialchars($userData['telefono']); ?></span>
            </div>
            <div class="profile-row">
                <label>Tipo de Usuario:</label>
                <span class="value"><?= htmlspecialchars($userData['tipo_usuario']); ?></span>
            </div>
            <div class="profile-row">
                <label>Fecha de Registro:</label>
                <span class="value"><?= htmlspecialchars($userData['fecha_registro']); ?></span>
            </div>
        </div>
        <div class="profile-footer">
            © 2024 - Perfil de Usuario
        </div>
    </div>
</body>
</html>
