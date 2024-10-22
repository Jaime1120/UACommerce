<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hola Mundo en PHP</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f8ff;
            font-family: Arial, sans-serif;
            color: #333;
            text-align: center;
        }
        h1 {
            font-size: 3em;
            margin: 0;
            padding: 20px;
            background: linear-gradient(45deg, #ff6b6b, #f7d9b0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        p {
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <h1>
        <?php echo "¡Hola, mundo!"; ?>
    </h1>
    <p>Este es un saludo desde PHP.</p>
</body>
</html>
