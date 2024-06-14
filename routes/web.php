<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('auth.login');
});

Route::view('/users/create', 'users.create')->name('users.create');
Route::view('/clientes/create', 'clientes.create')->name('clientes.create');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dash.index');
    })->name('dash');
    Route::get('/home', function (){
        return view('dash.index');
    })->name('home');

    //Rutas de usuarios
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

    //Rutas de clientes
    Route::get('/clientes', [\App\Http\Controllers\ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/{cliente}', [\App\Http\Controllers\ClienteController::class, 'show'])->name('clientes.show');
    Route::post('/clientes', [\App\Http\Controllers\ClienteController::class, 'store'])->name('clientes.store');
    Route::put('/clientes/{cliente}', [\App\Http\Controllers\ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/clientes/{cliente}', [\App\Http\Controllers\ClienteController::class, 'destroy'])->name('clientes.destroy');
    Route::get('/clientes/{cliente}/edit', [\App\Http\Controllers\ClienteController::class, 'edit'])->name('clientes.edit');
    Route::get('/clientes/create', [\App\Http\Controllers\ClienteController::class, 'create'])->name('clientes.create');

    //Rutas de proveedores
    Route::get('/proveedores', [\App\Http\Controllers\ProveedorController::class, 'index'])->name('proveedores.index');
    Route::get('/proveedores/create', [\App\Http\Controllers\ProveedorController::class, 'create'])->name('proveedores.create');
    Route::post('/proveedores', [\App\Http\Controllers\ProveedorController::class, 'store'])->name('proveedores.store');
    Route::get('/proveedores/{proveedor}', [\App\Http\Controllers\ProveedorController::class, 'show'])->name('proveedores.show');
    Route::put('/proveedores/{proveedor}', [\App\Http\Controllers\ProveedorController::class, 'update'])->name('proveedores.update');
    Route::delete('/proveddores/{proveedor}', [\App\Http\Controllers\ProveedorController::class, 'destroy'])->name('proveedores.destroy');
    Route::get('/proveedores/{proveedor}/edit', [\App\Http\Controllers\ProveedorController::class, 'edit'])->name('proveedores.edit');
});

Route::get('/vehiculos', [\App\Http\Controllers\VehiculoController::class, 'index'])->name('vehiculos.index');
Route::get('/ventas', [\App\Http\Controllers\VentaController::class, 'index'])->name('ventas.index');
Route::get('/servicios', [\App\Http\Controllers\ServicioController::class, 'index'])->name('servicios.index');
Route::get('/inventario', [\App\Http\Controllers\InventarioController::class, 'index'])->name('inventario.index');
