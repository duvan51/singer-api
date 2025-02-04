<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//controllers 
use App\Http\Controllers\Api\SongController; // Cambiado a PascalCase

Route::get('/songs', [SongController::class, 'index']);
Route::get('/songs/{id}', [SongController::class, 'show']); // Usar el controlador
Route::post('/songs', [SongController::class, 'store']);
Route::delete('/songs/{id}', [SongController::class, 'destroy']); // Usar el controlador
Route::put('/songs/{id}', [SongController::class, 'update']); // Usar el controlador