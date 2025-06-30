<?php

//Importación de controladores y de la clase route
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
use Illuminate\Support\Facades\Route; // La clase Route es una facade que proporciona acceso a las funcionalidades del enrutador del framework

// Ruta de la pantalla inicial del sitio web
Route::get('/', function () {
    return view('inicio');  //Devuelve la vista de inicio
});

// Rutas para el formulario de registro y proceso del mismo
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register'); //Muestra el formulario de registro al usuario
Route::post('/register', [RegisterController::class, 'register']); //Procesa el formulario enviado por el usuario

//Rutas para el formulario de inicio de sesión, proceso y cierre de sesión 
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login'); //Muestra el formulario de login al usuario
Route::post('/login', [LoginController::class, 'login']); //Procesa el formulario enviado por el usuario
Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); //Se encarga de cerrar la sesión del usuario autenticado

//Ruta para el menú principal para empezar a navegar a través de la página web
Route::get('/home', function () {
    return view('home');
})->name('home');

//RUTAS DEL MENÚ PRINCIPAL

//Rutas del panel de administración

Route::middleware(['auth'])->get('/panel', function () {
    return view('admin.panel');  //Devuelve la vista del panel de administración
})->name('admin.panel');

Route::middleware(['auth'])->group(function () {
    // Gestión de Usuarios: listado, editar, actualizar y eliminar
    Route::get('/userlist', [AdminUserController::class, 'index'])->name('admin.userlist'); //Listado de usuarios existentes en la BBDD
    Route::get('/userlist/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.userlist.edit'); //Vista de edición de usuario
    Route::put('/userlist/{id}', [AdminUserController::class, 'update'])->name('admin.userlist.update'); //Actualizar la información del usuario
    Route::delete('/userlist/{id}', [AdminUserController::class, 'destroy'])->name('admin.userlist.destroy'); //Eliminar al usuario de la BBDD

    // Gestión de Productos: listado , ver detalles y eliminar
    Route::get('/productlist', [AdminProductController::class, 'index'])->name('admin.productlist'); //Listado de productos
    Route::get('/productlist/{id}', [AdminProductController::class, 'show'])->name('admin.productlist.show'); //Ver producto
    Route::delete('/productlist/{id}', [AdminProductController::class, 'destroy'])->name('admin.productlist.destroy'); //Eliminar el producto de BBDD

    // Gestión de Productos: vista de selección (activas o historial), listado activas, ver y resolver, listado historial
    Route::get('/admin/denuncias', function() { return view('admin.denuncias');})->name('admin.denuncias'); //Vista de selección (activas o historial)
    Route::get('/admin/denuncias/activas', [AdminDenunciasController::class, 'activas'])->name('admin.denuncias.activas'); //Listado de activas
    Route::get('/admin/denuncias/historial', [AdminDenunciasController::class, 'historial'])->name('admin.denuncias.historial'); //Listado de denuncias resueltas
    Route::get('/admin/denuncias/{id}', [AdminDenunciasController::class, 'showDenuncia'])->name('admin.denuncias.show'); //Ver detalles de la denuncia activa
    Route::post('/admin/denuncias/{id}/resolver', [AdminDenunciasController::class, 'guardarResolucion'])->name('admin.denuncias.resolver'); //Resolver la denuncia activa, guardando la resolución de la misma

});

//Rutas para la edición del perfil del usuario

Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [ProfileController::class, 'perfil'])->name('profile.perfil'); //Formulario de edición de perfil
    Route::post('/perfil', [ProfileController::class, 'update'])->name('profile.update'); //Procesa el formulario enviado por el usuario y actualiza sus datos
});

//Rutas de productos que hay en el sitio web

Route::get('/productos', [ProductController::class, 'stock'])->name('productos.stock'); //Listado de productos posteados
Route::get('/productos/buscar', [ProductController::class, 'buscar'])->name('productos.buscar'); //Formulario de búsqueda de producto
Route::get('/productos/crear', [ProductController::class, 'create'])->name('productos.create'); //Formulario para subir un producto a la web
Route::post('/productos', [ProductController::class, 'store'])->name('productos.store'); //Procesa el formulario y muestra el listado de productos actualizado
Route::get('/productos/personales', [ProductController::class, 'personales'])->name('productos.personales'); //Listado de productos posteados por ti
Route::get('/productos/{id}', [ProductController::class, 'show'])->name('productos.show'); //Ver los detalles de un artículo
Route::get('/productos/{id}/editar', [ProductController::class, 'edit'])->name('productos.edit'); //Formulario de edición de un artículo
Route::put('/productos/{id}', [ProductController::class, 'update'])->name('productos.update'); //Procesa el formulario y actualiza los datos
Route::delete('/productos/{id}', [ProductController::class, 'destroy'])->name('productos.destroy'); //Eliminación de un producto 

//Rutas de solicitudes

Route::post('/solicitudes/enviar', [SolicitudController::class, 'enviar'])->name('solicitudes.enviar'); //Procesa la petición y la envia al vendedor (se envia en la parte de productos)

Route::middleware(['auth'])->group(function () {
    Route::get('/solicitudes', [SolicitudController::class, 'index'])->name('solicitudes.index'); //Listado de solicitudes
    Route::post('/solicitudes/{id}/aceptar', [SolicitudController::class, 'responder'])->name('solicitudes.aceptar'); //Procesa la respuesta
    Route::post('/solicitudes/{id}/rechazar', [SolicitudController::class, 'responder'])->name('solicitudes.rechazar'); //Procesa la respuesta
    Route::post('/solicitudes/{id}/entregar', [SolicitudController::class, 'responder'])->name('solicitudes.entregar'); //Procesa la respuesta de cambio de estado de aceptado a entregado
    Route::delete('/solicitudes/{id}', [SolicitudController::class, 'destroy'])->name('solicitudes.destroy'); //Elimina la solicitud si esta se encuentra en entregado o rechazada

});

//Rutas de chats

Route::middleware(['auth'])->group(function () {
    Route::get('chats', [ChatController::class, 'index'])->name('chat.index'); //Listado de chats abiertos con otros usuarios
    Route::get('/chat/{userId}', [ChatController::class, 'show'])->name('chat.show'); //Mostrar conversación de chat con otro usuario
    Route::post('/chat', [ChatController::class, 'store'])->name('chat.store'); //Enviar mensaje al usuario y almacenarlo para poder verlo de nuevo en otro momento
    Route::post('/chat/iniciar', [ChatController::class, 'iniciar'])->name('chat.iniciar'); //Iniciar chat con un usuario (se encuentra en la parte de productos)
});

// Rutas para denuncias

Route::middleware(['auth'])->group(function () {
    Route::get('/denuncia/producto/{producto}', [DenunciaController::class, 'crearProducto'])->name('denuncia.producto'); //Formulario de denuncia hacia un producto
    Route::post('/denuncia/producto/{producto}', [DenunciaController::class, 'guardarProducto'])->name('denuncia.producto.guardar'); //Procesa el formmulario y envia la denuncia
    Route::get('/denuncia/usuario/{usuario}', [DenunciaController::class, 'crearUsuario'])->name('denuncia.usuario'); //Formulario de denuncia hacia un usuario
    Route::post('/denuncia/usuario/{usuario}', [DenunciaController::class, 'guardarUsuario'])->name('denuncia.usuario.guardar'); //Procesa el formmulario y envia la denuncia
});