<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function(){
    Route::get('/listar_usuarios', [UsuarioController::class, 'listar_usuarios'])->name('listar_usuarios');
    Route::post('/crear_usuario', [UsuarioController::class, 'crear_usuario'])->name('crear_usuario');
    Route::delete('/eliminar_usuario/{id}', [UsuarioController::class, 'eliminar_usuario'])->name('eliminar_usuario');
});

require __DIR__.'/auth.php';
