<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mensaje de Contacto - LadrilloWeb</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <h2 style="color: #c2410c;">Nuevo mensaje recibido desde LadrilloWeb</h2>
    <p><strong>Nombre del remitente:</strong> {{ $name }}</p>
    <p><strong>Correo electrónico:</strong> {{ $email }}</p>
    <hr style="border: 0; border-top: 1px solid #ccc;">
    <h3>Mensaje:</h3>
    <p style="background-color: #f9fafb; padding: 15px; border-radius: 5px;">{{ $userMessage }}</p>
</body>
</html>