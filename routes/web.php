<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;

Route::get('/', [ProductController::class, 'index'])->name('home');  // Página de inicio
Route::get('/productos', [ProductController::class, 'index'])->name('productos.index'); // Página de productos

// Rutas para el carrito
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove-one/{productId}', [CartController::class, 'removeOneFromCart'])->name('cart.removeOne');
Route::post('/cart/remove-all/{productId}', [CartController::class, 'removeAllFromCart'])->name('cart.removeAll');


Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');




// Mostrar la página de autenticación con login y registro
Route::view('/login', 'auth')->name('login');
 // Ruta para la vista combinada de auth

// Procesar login y registro
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

// Ruta para recuperar contraseña
Route::post('/password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/signout', [AuthController::class, 'signout'])->name('signout');

