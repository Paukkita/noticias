<?php

use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\UserController;
use App\Models\Noticia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

//Ruta principal
Route::get('/', [NoticiaController::class, 'index'])->name('main');

//Metodo para  iniciar registro
Route::get('/auth/register', function () {
    return view('auth.register');
})->name('auth.register.get');

//Metodo para  registrar usuario
Route::post('/auth/register', [UserController::class, 'store'])->name('auth.register.post');

//Metodo para iniciar login
Route::get('/auth', function () {
    Auth::logout();
    return view('auth.login');
})->name('auth.login.get');

//Metodo para iniciar sesion
Route::post('/auth', [UserController::class, 'login'])->name('auth.login.post');

//Metodo para acceder a crear una noticia
Route::get('/noticias', function () {return view('noticias.create');})->name('noticias.create.get');

//Metodo para crear la noticia
Route::post('/noticias', [NoticiaController::class, 'store'])->name('noticias.store');

//Metodo para ver la noticia completa 
Route::get('/noticias/{noticia}', [NoticiaController::class, 'show'])->name('noticias.show');

//Metodo para eliminar una noticia
Route::delete('/noticias/{noticia}/eliminar',[NoticiaController::class, 'destroy'])->name('noticias.destroy'); 

//Metodo para acceder a la edicion
Route::get('/noticias/{noticia}/editar', [NoticiaController::class, 'edit'])->name('noticias.edit.get');

//Metodo para editar una noticia
Route::put('/noticias/{noticia}', [NoticiaController::class, 'update'])->name('noticias.edit.put');

//Metodo para ver todos los lectores
Route::get('/users/show',[UserController::class, 'index'])->name('users.show');

//Metodo para ver un unico usuario
Route::get('/users/{user}', [UserController::class, 'ver'])->name('user.get');

//Metodo para accedera editar usuarios
Route::get('/users/{user}/editar', [UserController::class, 'edit'])->name('users.get');

//Metodo para editar usuarios
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.put');

//Metodo para eliminar un usuario
Route::delete('/users/{user}/eliminar',[UserController::class, 'destroy'])->name('users.destroy'); 

// Ruta para dar "Me gusta" a una noticia
Route::post('/noticias/{noticia}/like', [NoticiaController::class, 'like'])->name('noticias.like');

// Ruta para quitar el "Me gusta"
Route::delete('/noticias/{noticia}/unlike', [NoticiaController::class, 'unlike'])->name('noticias.unlike');

