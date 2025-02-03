<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//controllers 
use App\Http\Controllers\Api\songController;



Route::get('/songs', [songController:: class, 'index']);

Route::get('/songs/{id}', function(){
    return 'una singer';
});
Route::post('/songs', [songController:: class, 'store']);

Route::delete('/songs/{id}', function(){
    return 'deleted students';
});

Route::put('/songs/{id}', function(){
    return 'songs update';
});