<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Cancelado - Perolito Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/payment-cancel.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    <div class="cancel-card">
        <div class="cancel-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>
        </div>
        <h1>Pago Cancelado</h1>
        <p>Has cancelado el proceso de pago. No te preocupes, puedes volver a intentarlo cuando estés listo o regresar a la tienda para seguir explorando.</p>
        <div class="action-buttons">
            <a href="{{ route('cart.show') }}" class="btn btn-primary">Volver al Carrito</a>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Seguir Comprando</a>
        </div>
    </div>
</div>
</body>
</html>
