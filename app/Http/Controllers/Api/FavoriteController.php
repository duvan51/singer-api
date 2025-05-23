<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Song;
use App\Models\User;

class FavoriteController extends Controller

{   
    public function toggleFavorite(Request $request){
    return response()->json(['llegué' => true]);
    }




    public function toggleFavorites(Request $request){
        dd("Estoy aquí");
        
        // Verificar si el usuario está autenticado
        $request->validate([
            'user_id' => 'required|exists:users,id', // Validar que el usuario exista
            'song_id' => 'required|exists:songs,id', // Validar que la canción exista
        ]);

        // Obtener el usuario enviado en la petición
        $user = User::find($request->user_id);
        dd($user); // aquí ves toda la info del usuario autenticado

        if (!$user) {
            return response()->json(['message' => 'No autenticado'], 401);
        }

        // Validar que el ID de la canción está presente
        $request->validate([
            'song_id' => 'required|exists:songs,id',
        ]);

        $songId = $request->song_id;
        
       
        
        // Verificar si ya está en favoritos
        if ($user->favoriteSongs()->where('song_id', $songId)->exists()) {
            $user->favoriteSongs()->detach($songId);
            return response()->json(['message' => 'Canción eliminada de favoritos']);
        } else {
            $user->favoriteSongs()->attach($songId);
            return response()->json(['message' => 'Canción añadida a favoritos']);
        }
    }






    public function getFavorites(Request $request){
    $request->validate([
        'user_id' => 'required|exists:users,id'
    ]);

    $user = User::find($request->user_id);

    if (!$user) {
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }

    return response()->json($user->favoriteSongs);
    }



}
