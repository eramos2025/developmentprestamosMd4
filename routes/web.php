<?php

use Illuminate\Support\Facades\Route;
USE Illuminate\Support\Facades\Auth;

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/prueba', function () {
    return view('prueba');
});

Route::get('/',[App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); // no modifico el /home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.index')->middleware('auth');

// RUTAS MODULO :: Admin :: X Revisar
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');

//=========================================================================================
// RUTAS MODULO :: Configuraciones ::
Route::get('/admin/configuraciones', 
           [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('admin.configuracion.index')->middleware('auth');
// CRUD Configuraciones
// Crear
Route::get('/admin/configuraciones/create', 
           [App\Http\Controllers\ConfiguracionController::class, 'create'])->name('admin.configuracion.create')->middleware('auth');
Route::post('/admin/configuraciones/create', 
           [App\Http\Controllers\ConfiguracionController::class, 'store'])->name('admin.configuracion.store')->middleware('auth');
// Leer
Route::get('/admin/configuraciones/{id}', 
           [App\Http\Controllers\ConfiguracionController::class, 'show'])->name('admin.configuracion.show')->middleware('auth');
// Actualiza
Route::get('/admin/configuraciones/{id}/edit', 
           [App\Http\Controllers\ConfiguracionController::class, 'edit'])->name('admin.configuracion.edit')->middleware('auth');
Route::put('/admin/configuraciones/{id}', 
           [App\Http\Controllers\ConfiguracionController::class, 'update'])->name('admin.configuracion.update')->middleware('auth');
// Eliminar
Route::delete('/admin/configuraciones/{id}', 
           [App\Http\Controllers\ConfiguracionController::class, 'destroy'])->name('admin.configuracion.destroy')->middleware('auth');
//=========================================================================================
// RUTAS MODULO :: Roles ::
Route::get('/admin/roles', 
           [App\Http\Controllers\RoleController::class, 'index'])->name('admin.roles.index')->middleware('auth');
// CRUD Configuraciones
// Crear
Route::get('/admin/roles/create', 
           [App\Http\Controllers\RoleController::class, 'create'])->name('admin.roles.create')->middleware('auth');
Route::post('/admin/roles/create', 
           [App\Http\Controllers\RoleController::class, 'store'])->name('admin.roles.store')->middleware('auth');
// Leer
Route::get('/admin/roles/{id}', 
           [App\Http\Controllers\RoleController::class, 'show'])->name('admin.roles.show')->middleware('auth');
// Actualiza
Route::get('/admin/roles/{id}/edit', 
           [App\Http\Controllers\RoleController::class, 'edit'])->name('admin.roles.edit')->middleware('auth');
Route::put('/admin/roles/{id}', 
           [App\Http\Controllers\RoleController::class, 'update'])->name('admin.roles.update')->middleware('auth');
// Eliminar
Route::delete('/admin/roles/{id}', 
           [App\Http\Controllers\RoleController::class, 'destroy'])->name('admin.roles.destroy')->middleware('auth');

//=========================================================================================
// RUTAS MODULO :: Usuarios ::
Route::get('/admin/usuarios', 
           [App\Http\Controllers\UsuarioController::class, 'index'])->name('admin.usuarios.index')->middleware('auth');
// CRUD Configuraciones Usuarios
// Crear
Route::get('/admin/usuarios/create', 
           [App\Http\Controllers\UsuarioController::class, 'create'])->name('admin.usuarios.create')->middleware('auth');
Route::post('/admin/usuarios/create', 
           [App\Http\Controllers\UsuarioController::class, 'store'])->name('admin.usuarios.store')->middleware('auth');
// Leer
Route::get('/admin/usuarios/{id}', 
           [App\Http\Controllers\UsuarioController::class, 'show'])->name('admin.usuarios.show')->middleware('auth');
// Actualiza
Route::get('/admin/usuarios/{id}/edit', 
           [App\Http\Controllers\UsuarioController::class, 'edit'])->name('admin.usuarios.edit')->middleware('auth');
Route::put('/admin/usuarios/{id}', 
           [App\Http\Controllers\UsuarioController::class, 'update'])->name('admin.usuarios.update')->middleware('auth');
// Eliminar
Route::delete('/admin/usuarios/{id}', 
           [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy')->middleware('auth');

//=========================================================================================
// RUTAS MODULO :: Clientes ::
Route::get('/admin/clientes', 
           [App\Http\Controllers\ClienteController::class, 'index'])->name('admin.clientes.index')->middleware('auth');
// CRUD Configuraciones Clientes
// Crear
Route::get('/admin/clientes/create', 
           [App\Http\Controllers\ClienteController::class, 'create'])->name('admin.clientes.create')->middleware('auth');
Route::post('/admin/clientes/create', 
           [App\Http\Controllers\ClienteController::class, 'store'])->name('admin.clientes.store')->middleware('auth');
// Leer
Route::get('/admin/clientes/{id}', 
           [App\Http\Controllers\ClienteController::class, 'show'])->name('admin.clientes.show')->middleware('auth');
// Actualiza
Route::get('/admin/clientes/{id}/edit', 
           [App\Http\Controllers\ClienteController::class, 'edit'])->name('admin.clientes.edit')->middleware('auth');
Route::put('/admin/clientes/{id}', 
           [App\Http\Controllers\ClienteController::class, 'update'])->name('admin.clientes.update')->middleware('auth');
// Eliminar
Route::delete('/admin/clientes/{id}', 
           [App\Http\Controllers\ClienteController::class, 'destroy'])->name('admin.clientes.destroy')->middleware('auth');

// Ruta para eliminar archivo individual
Route::delete('/admin/clientes/archivos/{id}', [App\Http\Controllers\ClienteController::class, 'deleteArchivo'])
    ->name('clientes.archivo.delete')->middleware('auth');

//Prueba: solo para mostrar la version original xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
Route::get('/admin/clientes/old/create', 
           [App\Http\Controllers\ClienteController::class, 'prueba'])->name('admin.clientes.old.prueba')->middleware('auth');

//=========================================================================================
// RUTAS MODULO :: Inversionista ::
Route::get('/admin/inversionistas', 
           [App\Http\Controllers\InversionistaController::class, 'index'])->name('admin.inversionistas.index')->middleware('auth');
// CRUD Configuraciones Inversionista
// Crear
Route::get('/admin/inversionistas/create', 
           [App\Http\Controllers\InversionistaController::class, 'create'])->name('admin.inversionistas.create')->middleware('auth');
Route::post('/admin/inversionistas/create', 
           [App\Http\Controllers\InversionistaController::class, 'store'])->name('admin.inversionistas.store')->middleware('auth');
// Leer
Route::get('/admin/inversionistas/{id}', 
           [App\Http\Controllers\InversionistaController::class, 'show'])->name('admin.inversionistas.show')->middleware('auth');
// Actualiza
Route::get('/admin/inversionistas/{id}/edit', 
           [App\Http\Controllers\InversionistaController::class, 'edit'])->name('admin.inversionistas.edit')->middleware('auth');
Route::put('/admin/inversionistas/{id}', 
           [App\Http\Controllers\InversionistaController::class, 'update'])->name('admin.inversionistas.update')->middleware('auth');
// Eliminar
Route::delete('/admin/inversionistas/{id}', 
           [App\Http\Controllers\InversionistaController::class, 'destroy'])->name('admin.inversionistas.destroy')->middleware('auth');
