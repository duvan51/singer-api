<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Song;
use App\Models\User;

class FavoriteController extends Controller
{
    public function toggleFavorite(Request $request)
    {
        // Verificar si el usuario está autenticado
        $user = Auth::user();
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

    public function getFavorites()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'No autenticado'], 401);
        }

        return response()->json($user->favoriteSongs);
    }
}
