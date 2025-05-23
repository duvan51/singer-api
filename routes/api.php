<?php
use Illuminate\Http\Request;

//controllers 
use App\Http\Controllers\Api\songController; // Cambiado a PascalCase

use App\Http\Controllers\Api\categoryController; // Cambiado a PascalCase

use App\Http\Controllers\Api\UserController; 
use App\Http\Controllers\Api\FavoriteController; 
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\repertorioController;
use App\Http\Controllers\Api\repertorioSongController;
use App\Http\Controllers\Api\repertorio_song_category_Controller;
use App\Http\Controllers\Api\comentariosController;
use App\Http\Controllers\Api\customSongController;



use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Log;



Route::get('/songs', [songController::class, 'index']);
Route::get('/songs/{id}', [songController::class, 'show']);
Route::post('/songs', [songController::class, 'store']);
Route::put('/songs/{id}', [songController::class, 'update']); 
Route::delete('/songs/{id}', [songController::class, 'destroy']);

Route::get('/search', [songController::class, 'search']);



//aqui van las categorias
Route::get('/category', [categoryController::class, 'index']);
Route::post('/category', [categoryController::class, 'store']);
Route::put('/category/{id}', [categoryController::class, 'update']); 

//aqui van los usuarios
Route::post('/users', [UserController::class, 'store']);
Route::get('/users', [UserController::class, 'index']);
//Route::get('/user/{id}', [UserController::class, 'show']);
Route::middleware('auth:sanctum')->get('/user/{id}', [UserController::class, 'show']);

Route::post('/login', [UserController::class, 'login']);


//favorites post

Route::post('/favorites/toogle', [FavoriteController::class, 'toggleFavorite']);
//Route::middleware('auth:sanctum')->post('/favorites/toggle', [FavoriteController::class, 'toggleFavorite']);
Route::get('/favorites/toogle', [FavoriteController::class, 'getFavorites']);


//Groups
//Route::post('/groups', [GroupController::class, 'store']);
//Route::get('/groups', [GroupController::class, 'index']);

    Route::post('/groups', [GroupController::class, 'store']);
    Route::get('/groups', [GroupController::class, 'index']);
    Route::get('/groups/{id}', [GroupController::class, 'show']); 


 //repertorios 

 Route::post('/repertorios', [repertorioController::class, 'store']); //
 Route::get('/repertorios', [repertorioController::class, 'index']);
 Route::get('/repertorios/{id}', [repertorioController::class, 'show']);

 

 //reportoriossongs 
 Route::post('/repertoriosongs', [repertorioSongController::class, 'store']);
 Route::get('/repertoriosongs', [repertorioSongController::class, 'index']);
 
 //repertorio_song_category
 Route::post('/repertoriosongcategory', [repertorio_song_category_Controller::class, 'store']);
 Route::get('/repertoriosongcategory', [repertorio_song_category_Controller::class, 'index']);
 Route::get('/repertoriosongcategory/{id}', [repertorio_song_category_Controller::class, 'show']);

 Route::post('/comentarios', [comentariosController::class, 'store']); 
 Route::post('/comentarios', [comentariosController::class, 'store']);


 //custom songs
 Route::post('/customSong', [customSongController::class, 'store']); 
 Route::get('/customSong/{id}', [customSongController::class, 'show']);
 
 



Route::get('/test-password', function () {
    $inputPassword = '123456';
    $storedPassword = '$2y$12$0UwctuDhl1Kom0yGNiv.4.41hBGG5kI3a1rsd8I2SyNsi0\/o.lz9.';

    return Hash::check($inputPassword, $storedPassword) ? 'Contraseña correcta' : 'Contraseña incorrecta';
});
