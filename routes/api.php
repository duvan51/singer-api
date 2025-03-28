<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//controllers 
use App\Http\Controllers\Api\songController; // Cambiado a PascalCase

use App\Http\Controllers\Api\categoryController; // Cambiado a PascalCase

Route::get('/songs', [songController::class, 'index']);
Route::get('/songs/{id}', [songController::class, 'show']);
Route::post('/songs', [songController::class, 'store']);
Route::put('/songs/{id}', [SongController::class, 'update']); 
Route::delete('/songs/{id}', [SongController::class, 'destroy']);

Route::get('/search', [SongController::class, 'search']);



//aqui van las categorias
Route::get('/category', [categoryController::class, 'index']);
Route::post('/category', [categoryController::class, 'store']);