<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
{
    if (!session()->has('idToken')) {
        return redirect()->route('login'); // Redirigir a la página de inicio de sesión
    }

    // Obtener todos los productos de la base de datos
    $products = Product::all();

    return view('products.index', compact('products'));
}

}
