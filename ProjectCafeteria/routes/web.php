<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PrecioController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\PedidoController;


Route::get('/', function () {
    return view('principal');
});
Auth::routes();

Route::get('/usuarios', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'], function () {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('clientes', ClienteController::class);

    Route::resource('home', HomeController::class);

    Route::resource('categorias', CategoriaController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('precios', PrecioController::class);
    Route::resource('catalogos', CatalogoController::class);
    Route::get('/catalogos', [CatalogoController::class, 'index'])->name('catalogos.index');

    Route::resource('ventas', VentaController::class);
    Route::resource('pedidos', PedidoController::class);

    Route::Resource('vouchers', VoucherController::class);

    Route::get('/vouchers/generate/{id}', [VoucherController::class, 'generateVoucher'])->name('vouchers.generate');


    //definir la ruta a verProducto
    Route::get('productos/{producto}/verProducto', [ProductoController::class, 'verProducto'])->name('productos.verProducto');

    Route::post('cart/add', [App\Http\Controllers\CartController::class, 'add'])->name('add');
    Route::get('cart/checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('checkout');
    Route::get('cart/clear', [App\Http\Controllers\CartController::class, 'clear'])->name('clear');
    Route::post('cart/removeitem', [App\Http\Controllers\CartController::class, 'removeItem'])->name('removeitem');

    //definir la ruta a ver forma de pago
    Route::get('cart/formaPago', [App\Http\Controllers\CartController::class, 'formaPago'])->name('formaPago');
    Route::post('cart/pagoEfectivo', [App\Http\Controllers\CartController::class, 'confirmarPagoEfectivo'])->name('confirmarPagoEfectivo');

    Route::post('/session', [StripeController::class, 'session'])->name('session');
    Route::get('/success', function () {
        return view('success');
    })->name('success');
    Route::get('/checkout', function () {
        return view('cart.checkout');
    })->name('checkout');
    Route::get('/summary', [StripeController::class, 'summary'])->name('summary'); // Define la ruta summary

    Route::resource('vouchers', VoucherController::class);
    Route::get('/voucher', [VoucherController::class, 'generateVoucher'])->name('voucher.generate');

    Route::get('/delivery', [VoucherController::class, 'verdelivery']);

    Route::get('/principal', function () {
        return view('principal');
    });
});
