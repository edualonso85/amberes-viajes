
<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProveedorController;
use Illuminate\Support\Facades\Auth;

// Rutas de autenticación (Laravel Breeze, Fortify o UI recomendado para login real)

// Redirigir home a login
Route::get('/', function() { return redirect('/login'); });
Auth::routes();

// Dashboard protegido
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('clientes', ClienteController::class);
    Route::resource('proveedores', ProveedorController::class)->parameters(['proveedores' => 'proveedor']);
    Route::resource('vendedores', App\Http\Controllers\VendedorController::class)->parameters(['vendedores' => 'vendedor'])->middleware('role:admin');
    Route::post('/logout', function() {
        Auth::logout();
        return redirect('/login');
    })->name('logout');
    
    Route::resource('usuarios', App\Http\Controllers\UserController::class)->parameters(['usuarios' => 'user'])->middleware('role:admin');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
