<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminDenunciasController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\DenunciaController;
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

Route::middleware(['auth'])->get('/panel', function () {
    return view('admin.panel');
})->name('admin.panel');

Route::middleware(['auth'])->group(function () {
    // Usuarios: listado, editar, actualizar, eliminar
    Route::get('/userlist', [AdminUserController::class, 'index'])->name('admin.userlist');
    Route::get('/userlist/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.userlist.edit');
    Route::put('/userlist/{id}', [AdminUserController::class, 'update'])->name('admin.userlist.update');
    Route::delete('/userlist/{id}', [AdminUserController::class, 'destroy'])->name('admin.userlist.destroy');

    // Productos: listado admin, ver detalle, eliminar
    Route::get('/productlist', [AdminProductController::class, 'index'])->name('admin.productlist');
    Route::get('/productlist/{id}', [AdminProductController::class, 'show'])->name('admin.productlist.show');
    Route::delete('/productlist/{id}', [AdminProductController::class, 'destroy'])->name('admin.productlist.destroy');

    Route::get('/admin/denuncias', function() { return view('admin.denuncias');})->name('admin.denuncias');
    Route::get('/admin/denuncias/activas', [AdminDenunciasController::class, 'activas'])->name('admin.denuncias.activas');
    Route::get('/admin/denuncias/historial', [AdminDenunciasController::class, 'historial'])->name('admin.denuncias.historial');
    Route::get('/admin/denuncias/{id}', [AdminDenunciasController::class, 'showDenuncia'])->name('admin.denuncias.show');
    Route::post('/admin/denuncias/{id}/resolver', [AdminDenunciasController::class, 'guardarResolucion'])->name('admin.denuncias.resolver');

});


Route::middleware(['auth'])->group(function () {
    // Página de perfil
    Route::get('/perfil', [ProfileController::class, 'perfil'])->name('profile.perfil');
    
    // Actualizar perfil
    Route::post('/perfil', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/productos', [ProductController::class, 'stock'])->name('productos.stock'); // stock.blade.php
Route::get('/productos/buscar', [ProductController::class, 'buscar'])->name('productos.buscar');
Route::get('/productos/personales', [ProductController::class, 'personales'])->name('productos.personales'); // personales.blade.php
Route::get('/productos/crear', [ProductController::class, 'create'])->name('productos.create'); // create.blade.php
Route::post('/productos', [ProductController::class, 'store'])->name('productos.store'); // no necesita vista
Route::get('/productos/{id}', [ProductController::class, 'show'])->name('productos.show');
Route::get('/productos/{id}/editar', [ProductController::class, 'edit'])->name('productos.edit');
Route::put('/productos/{id}', [ProductController::class, 'update'])->name('productos.update');
Route::delete('/productos/{id}', [ProductController::class, 'destroy'])->name('productos.destroy');


Route::post('/solicitudes/enviar', [SolicitudController::class, 'enviar'])->name('solicitudes.enviar');

Route::middleware(['auth'])->group(function () {
    Route::get('/solicitudes', [SolicitudController::class, 'index'])->name('solicitudes.index');
    Route::post('/solicitudes/{id}/aceptar', [SolicitudController::class, 'responder'])->name('solicitudes.aceptar');
    Route::post('/solicitudes/{id}/rechazar', [SolicitudController::class, 'responder'])->name('solicitudes.rechazar');
    Route::post('/solicitudes/{id}/entregar', [SolicitudController::class, 'responder'])->name('solicitudes.entregar'); // nueva ruta
    Route::delete('/solicitudes/{id}', [SolicitudController::class, 'destroy'])->name('solicitudes.destroy');

});

Route::middleware(['auth'])->group(function () {
    Route::get('chats', [ChatController::class, 'index'])->name('chat.index');
    // Mostrar conversación de chat con otro usuario
    Route::get('/chat/{userId}', [ChatController::class, 'show'])->name('chat.show');

    // Enviar mensaje al usuario
    Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');

    // Iniciar o abrir chat
    Route::post('/chat/iniciar', [ChatController::class, 'iniciar'])->name('chat.iniciar');
});

// Rutas para denuncias de producto
Route::middleware(['auth'])->group(function () {
    Route::get('/denuncia/producto/{producto}', [DenunciaController::class, 'crearProducto'])->name('denuncia.producto');
    Route::post('/denuncia/producto/{producto}', [DenunciaController::class, 'guardarProducto'])->name('denuncia.producto.guardar');
    Route::get('/denuncia/usuario/{usuario}', [DenunciaController::class, 'crearUsuario'])->name('denuncia.usuario');
    Route::post('/denuncia/usuario/{usuario}', [DenunciaController::class, 'guardarUsuario'])->name('denuncia.usuario.guardar');
});





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
