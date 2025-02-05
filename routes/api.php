<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//controllers 
use App\Http\Controllers\Api\songController; // Cambiado a PascalCase

Route::get('/songs', [songController::class, 'index']);
Route::get('/songs/{id}', [songController::class, 'show']); // Usar el controlador
Route::post('/songs', [songController::class, 'store']);
//Route::delete('/songs/{id}', [SongController::class, 'destroy']); // Usar el controlador
//Route::put('/songs/{id}', [SongController::class, 'update']); // Usar el controlador