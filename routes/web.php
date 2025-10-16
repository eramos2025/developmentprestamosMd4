<?php

use Illuminate\Support\Facades\Route;
USE Illuminate\Support\Facades\Auth;

/*
Route::get('/', function () {
    return view('welcome');
});
*/

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
// CRUD Configuraciones
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


