<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - Perolito Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/cart-style.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<header class="header">
    <div class="container">
        <h1>Perolito Shop</h1>
        <nav>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Seguir comprando</a>
        </nav>
    </div>
</header>

<main class="container">
    <h2>Carrito de Compras</h2>

    @if($total > 0)
    <div class="cart-container">
        <table class="cart-table">
            <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($cart as $producto)
            <tr>
                <td class="product-info">
                    <img src="{{ asset('images/' . $producto['image']) }}" alt="{{ $producto['name'] }}">
                    <div>
                        <h3>{{ $producto['name'] }}</h3>
                        <p>{{ $producto['description'] }}</p>
                    </div>
                </td>
                <td>${{ number_format($producto['price'], 2) }}</td>
                <td>{{ $producto['quantity'] }}</td>
                <td>${{ number_format($producto['price'] * $producto['quantity'], 2) }}</td>
                <td class="actions">
                    <form action="{{ route('cart.removeOne', $producto['id']) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-remove">-</button>
                    </form>
                    <form action="{{ route('cart.removeAll', $producto['id']) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-remove-all">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        <div class="cart-summary">
            <h3>Resumen del pedido</h3>
            <p>Total: <span>${{ number_format($total, 2) }}</span></p>
            <form action="{{ route('payment.process') }}" method="post">
                @csrf
                <input type="hidden" name="total" value="{{ $total }}">
                @foreach ($cart as $producto)
                <input type="hidden" name="productos[{{ $producto['id'] }}][name]" value="{{ $producto['name'] }}">
                <input type="hidden" name="productos[{{ $producto['id'] }}][price]" value="{{ $producto['price'] }}">
                <input type="hidden" name="productos[{{ $producto['id'] }}][quantity]" value="{{ $producto['quantity'] }}">
                @endforeach
                <button type="submit" class="btn btn-primary">Proceder al pago</button>
            </form>
        </div>
    </div>
    @else
    <div class="empty-cart">
        <p>Tu carrito está vacío.</p>
        <a href="{{ route('productos.index') }}" class="btn btn-primary">Explorar productos</a>
    </div>
    @endif
</main>

<footer>
    <div class="container">
        <p>&copy; 2023 Perolito Shop. Todos los derechos reservados.</p>
    </div>
</footer>
</body>
</html>
