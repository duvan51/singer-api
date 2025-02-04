<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Song;

class SongController extends Controller // Cambiado a PascalCase
{
    public function index(){
        $songs = Song::all();
        if($songs->isEmpty()){
            $data = [
                'message' => 'No se encontraron canciones',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($songs, 200);
    }

    public function show($id){
        $song = Song::find($id);
        if(!$song){
            $data = [
                'message' => 'Canción no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($song, 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'autor' => 'required',
            'song' => 'required',
        ]);
        if($validator->fails()){
            $data = [
                'message' => 'Error al validar los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $song = Song::create([
            'name' => $request->name,
            'autor' => $request->autor,
            'song' => $request->song,
        ]);
        if(!$song){
            $data = [
                'message' => 'Error al crear la canción',
                'status' => 500
            ];
            return response()->json($data, 500);
        }
        $data = [
            'song' => $song,
            'status' => 201
        ];
        return response()->json($data, 201);
    }
}