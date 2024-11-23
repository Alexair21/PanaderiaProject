<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PlatilloController;
use App\Http\Controllers\Inicio;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\RepartidorController;
use App\Http\Controllers\SubcategoriaController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\MesaController;

Route::get('/', [Inicio::class, 'index'])->name('inicio');
Auth::routes();

Route::get('/usuarios', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'], function () {

    //Pagina principal
    Route::resource('home', HomeController::class);

    //Rutas de la gestion de los platillos
    Route::resource('categorias', CategoriaController::class);
    Route::resource('subcategorias', SubcategoriaController::class);
    Route::resource('catalogos', CatalogoController::class);
    Route::get('/catalogos', [CatalogoController::class, 'index'])->name('catalogos.index');

    //RUTAS PLATILLOS
    Route::resource('platillos', PlatilloController::class);
    Route::post('/platillos/{platillo}/toggle-estado', [PlatilloController::class, 'toggleEstado'])->name('platillos.toggleEstado');
    Route::post('/platillos/{platillo}/toggle-destacado', [PlatilloController::class, 'toggleDestacado'])->name('platillos.toggleDestacado');
    Route::delete('/platillos/{platillo}', [PlatilloController::class, 'destroy'])->name('platillos.destroy');
    // Definir la ruta para ver un platillo
    Route::get('platillos/{platillo}/verPlatillo', [PlatilloController::class, 'verPlatillo'])->name('platillos.verplatillo');


    //Rutas de la gestion de la venta
    Route::resource('pedidos', PedidoController::class);
    Route::Resource('vouchers', VoucherController::class);
    Route::get('/vouchers/generate/{id}', [VoucherController::class, 'generateVoucher'])->name('vouchers.generate');
    Route::resource('vouchers', VoucherController::class);
    Route::get('/voucher', [VoucherController::class, 'generateVoucher'])->name('voucher.generate');



    //Rutas del carrito de compras
    Route::post('cart/add', [App\Http\Controllers\CartController::class, 'add'])->name('add');
    Route::get('cart/checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('checkout');
    Route::get('cart/clear', [App\Http\Controllers\CartController::class, 'clear'])->name('clear');
    Route::post('cart/removeitem', [App\Http\Controllers\CartController::class, 'removeItem'])->name('removeitem');
    Route::post('cart/guardarVenta', [App\Http\Controllers\CartController::class, 'guardarVenta'])->name('guardarVenta');



    //Rutas de metodos de pagos
    Route::get('cart/formaPago', [App\Http\Controllers\CartController::class, 'formaPago'])->name('formaPago');
    Route::get('cart/estadoPagar/{venta}', [App\Http\Controllers\CartController::class, 'estadoPagar'])->name('estadoPagar');
    //Pago con Stripe
    Route::post('/session', [StripeController::class, 'session'])->name('session');
    Route::get('/success', function () {
        return view('success');
    })->name('success');
    Route::get('/checkout', function () {
        return view('cart.checkout');
    })->name('cart.checkout');
    Route::get('/summary', [StripeController::class, 'summary'])->name('summary'); // Define la ruta summary
    //cuando se paga en efectivo
    Route::post('cart/pagoEfectivo', [App\Http\Controllers\CartController::class, 'confirmarPagoEfectivo'])->name('confirmarPagoEfectivo');

    Route::get('/delivery', [VoucherController::class, 'verdelivery']);


    //Rutas de gestion de adminitrador
    Route::resource('roles', RolController::class);
    //ventana principal
    Route::get('/principal', function () {
        return view('principal');
    });
    Route::get('/inicio', function () {
        return view('principal');
    });
    Route::get('/inicio', [HomeController::class, 'principal']);

    //Rutas de usuarioes
    Route::resource('personal', PersonalController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('repartidor', RepartidorController::class);
    //se usa para ver detalles del pedido en la vista repartidor (Modal)
    Route::get('/repartidores/pedido/{id}', [RepartidorController::class, 'getPedidoDetalles']);

    //Rutas de administracion del restaurante
    Route::resource('salas', SalaController::class);
    Route::resource('mesas', MesaController::class);
    Route::get('/salas/{sala}/mesas', [MesaController::class, 'indexMesas'])->name('mesas.indexMesas');

});
