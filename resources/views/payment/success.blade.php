<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Completado - Perolito Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/payment-success.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    <div class="success-card">
        <div class="success-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
        </div>
        <h1>¡Pago Completado!</h1>
        <p>Gracias por tu compra. Tu pago ha sido procesado exitosamente.</p>
        <a href="{{ route('productos.index') }}" class="btn-back">Volver a la tienda</a>
    </div>
</div>
</body>
</html>
