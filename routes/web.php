<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Ruta de la pantalla inicial del sitio web
Route::get('/', function () {
    return view('inicio');
});

// Rutas para el formulario de registro y proceso del mismo
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

//Rutas para el formulario de inicio de sesión, proceso y cierre de sesión 
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Ruta para el menú principal de elección para navegación a través de la página web
Route::get('/home', function () {
    return view('home');
})->name('home');

Route::middleware(['auth'])->group(function () {
    // Página de perfil
    Route::get('/perfil', [ProfileController::class, 'perfil'])->name('profile.perfil');
    
    // Actualizar perfil
    Route::post('/perfil', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/productos', [ProductController::class, 'stock'])->name('productos.stock'); // stock.blade.php
Route::get('/productos/personales', [ProductController::class, 'personales'])->name('productos.personales'); // personales.blade.php
Route::get('/productos/crear', [ProductController::class, 'create'])->name('productos.create'); // create.blade.php
Route::post('/productos', [ProductController::class, 'store'])->name('productos.store'); // no necesita vista

/*Route::get('/', function () {
    return view('welcome');
});*/

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfilController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfilController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfilController::class, 'destroy'])->name('profile.destroy');
});*/

//require __DIR__.'/auth.php';
