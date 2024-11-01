<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perolito Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/product-style.css') }}">
</head>
<body>
<header class="header">
    <div class="container">
        <h1>Perolito Shop</h1>
        <nav>
            <a href="{{ route('cart.show') }}" class="btn btn-cart">Ver Carrito</a>
            <a href="{{ route('signout') }}" class="btn btn-signout">Cerrar Sesión</a>
        </nav>
    </div>
</header>

<main class="container">
    <h2>Nuestros Productos</h2>

    <div class="products">
        @foreach ($products as $product)
        <div class="product-card">
            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
            <div class="product-info">
                <h3>{{ $product->name }}</h3>
                <p class="price">${{ number_format($product->price, 2) }}</p>
                <form action="{{ route('cart.add', $product->id) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-add-to-cart">Agregar al carrito</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</main>

<footer>
    <div class="container">
        <p>&copy; 2023 Perolito Shop. Todos los derechos reservados.</p>
    </div>
</footer>
</body>
</html>
