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

    //definir la ruta a verProducto
    Route::get('productos/{producto}/verProducto', [ProductoController::class, 'verProducto'])->name('productos.verProducto');

    Route::get('/principal', function () {
        return view('principal');
    });
});

