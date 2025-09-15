<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .content {
            padding: 30px 20px;
        }
        .button {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>¡Bienvenido {{ $nombre }}!</h1>
        </div>

        <div class="content">
            <p>¡Gracias por registrarte en <strong>{{ config('app.name') }}</strong>!</p>

            <p>Tu cuenta ha sido creada exitosamente con los siguientes datos:</p>

            <p>Para comenzar a usar la plataforma, haz clic en el siguiente botón:</p>

            <div style="text-align: center;">
                <a href="{{ url('/dashboard') }}" class="button">Acceder al Dashboard</a>
            </div>

            <p>Si tienes alguna pregunta o necesitas ayuda, no dudes en contactarnos.</p>

            <p>¡Esperamos que disfrutes tu experiencia con nosotros!</p>
        </div>

        <div class="footer">
            <p>Este correo fue enviado automáticamente. Por favor, no responder a este mensaje.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
