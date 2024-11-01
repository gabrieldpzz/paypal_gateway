<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class CartController extends Controller
{
    // Mostrar el carrito
    public function showCart()
    {
        $cart = Session::get('carrito', []);
        $total = $this->calculateTotal($cart);

        return view('cart', compact('cart', 'total'));
    }

    // Agregar un producto al carrito
    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $cart = Session::get('carrito', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += 1;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'description' => $product->description,
                'image' => $product->image,
                'quantity' => 1,
            ];
        }

        Session::put('carrito', $cart);

        return redirect()->route('cart.show');
    }

    // Eliminar una unidad de un producto del carrito
    public function removeOneFromCart($productId)
    {
        $cart = Session::get('carrito', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] -= 1;
            if ($cart[$productId]['quantity'] <= 0) {
                unset($cart[$productId]);
            }
        }

        Session::put('carrito', $cart);

        return redirect()->route('cart.show');
    }

    // Eliminar todas las unidades de un producto del carrito
    public function removeAllFromCart($productId)
    {
        $cart = Session::get('carrito', []);
        unset($cart[$productId]);

        Session::put('carrito', $cart);

        return redirect()->route('cart.show');
    }

    // Calcular el total del carrito
    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $product) {
            $total += $product['price'] * $product['quantity'];
        }
        return $total;
    }
}
