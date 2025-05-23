<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RepertorioSong;

class repertorioSongController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'repertorio_id' => 'required|exists:repertorios,id',
            'song_id' => 'required|exists:song,id',
            'repertorio_song_category_id' => 'nullable|exists:repertorio_song_category,id',
            // otras validaciones según tus necesidades
        ]);

        RepertorioSong::create([
            'repertorio_id' => $request->repertorio_id,
            'song_id' => $request->song_id,
            'repertorio_song_category_id' => $request->repertorio_song_category_id,
            // otros campos según tus necesidades
        ]);

        // Retornar una respuesta adecuada
        return response()->json(['message' => 'Registro creado exitosamente'], 201);
    }

    public function index(){
        $repertorios = RepertorioSong::all();
        if($repertorios->isEmpty()){
            $data = [
                'message' => 'No se encontraron grupos canciones',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($repertorios, 200);
    }  
}

