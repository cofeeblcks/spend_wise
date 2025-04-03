<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a {{ config('app.name') }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #f3f4f6;
            padding: 30px 20px;
            text-align: center;
        }
        .email-header img {
            max-width: 180px;
            height: auto;
        }
        .email-body {
            padding: 30px;
            border-radius: 8px;
        }
        .email-title {
            color: #203A75;
            font-size: 24px;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .email-button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #203A75;
            color: white !important;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin: 10px 0;
        }
        .email-footer {
            background-color: #f1f1f1;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .email-panel {
            background-color: #f9f9f9;
            border-left: 4px solid #203A75;
            padding: 15px;
            margin: 20px 0 0 0;
        }
        .text-muted {
            color: #666;
        }
        .email-section{
            width: 100%;
            text-align: center;
            margin-bottom: 15px;
        }
        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 0;
                border-radius: 0;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <img src="{{ config('app.url') }}/favicon.png" alt="{{ config('app.name') }}">
        </div>

        <div class="email-body">
            {{ $body }}
        </div>

        <div class="email-footer">
            © 2025 {{ config('app.name') }}. Todos los derechos reservados.<br>
            <a href="mailto:{{ config('mail.support.address') }}">{{ config('mail.support.address') }}</a> |
            <a href="#">Política de Privacidad</a> |
            <a href="#">Términos de Servicio</a>
        </div>
    </div>
</body>
</html>
