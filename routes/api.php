<?php
use Illuminate\Http\Request;

//controllers 
use App\Http\Controllers\Api\songController; // Cambiado a PascalCase

use App\Http\Controllers\Api\categoryController; // Cambiado a PascalCase

use App\Http\Controllers\Api\UserController; 


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;


Route::get('/songs', [songController::class, 'index']);
Route::get('/songs/{id}', [songController::class, 'show']);
Route::post('/songs', [songController::class, 'store']);
Route::put('/songs/{id}', [SongController::class, 'update']); 
Route::delete('/songs/{id}', [SongController::class, 'destroy']);

Route::get('/search', [SongController::class, 'search']);



//aqui van las categorias
Route::get('/category', [categoryController::class, 'index']);
Route::post('/category', [categoryController::class, 'store']);


//aqui van los usuarios
Route::post('/users', [UserController::class, 'store']);
Route::get('/users', [UserController::class, 'index']);
//Route::get('/user/{id}', [UserController::class, 'show']);
Route::middleware('auth:sanctum')->get('/user/{id}', [UserController::class, 'show']);



Route::post('/login', [UserController::class, 'login']);



Route::get('/test-password', function () {
    $inputPassword = '123456';
    $storedPassword = '$2y$12$0UwctuDhl1Kom0yGNiv.4.41hBGG5kI3a1rsd8I2SyNsi0\/o.lz9.';

    return Hash::check($inputPassword, $storedPassword) ? 'Contraseña correcta' : 'Contraseña incorrecta';
});
