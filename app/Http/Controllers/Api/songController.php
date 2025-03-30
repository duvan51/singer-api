<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Song;

class songController extends Controller // Cambiado a PascalCase
{
    public function index(){
        $songs = Song::with('categories')->get();

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
        $song = Song::with('categories')->find($id);



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


    public function update(Request $request, $id){
        
        $song = Song::find($id);
        
        error_log("ID recibido: " . json_encode($id));

        if(!$song){
            $data=[
                'message' => 'Song no encontrada',
                'status' => 404
            ];
            return  response()->json($data, 404);
        }
        $request->validate([
            'song' => 'nullable|array',
            'categories' => 'nullable|array',
        ]);

         // Actualizar solo `song` sin convertirlo manualmente
        if ($request->has('song')) {
            $song->update([
            'song' => $request->input('song'),
        ]);
        }
         // Actualizar las categorías asociadas si vienen en la petición
        if ($request->has('categories')) {
            $song->categories()->sync($request->input('categories'));
        }

        return response()->json([
            'message' => 'Canción actualizada con éxito',
            'song' => $song->fresh()->load('categories') // devuelve la canción actualizada con categorías
        ], 200);

    }

    public function destroy($id){
        $song = Song::find($id);
        if(!$song){
            return response()->json(['message' => 'Song no encontrada'], 404);
        }
        $song->delete();

        return response()->json(['message' => 'Canción eliminada con éxito -> ', $song], 200);
    }



    public function search(Request $request)
{
    $query = $request->input('query');

    // Verifico que la petición no esté vacía
    if (!$query) {
        return response()->json([]);
    }

    // Buscar categorías que coincidan con el nombre ingresado
    $categories = Category::where('name', 'LIKE', "%{$query}%")->pluck('id');

    // Buscar canciones que pertenecen a esas categorías o que coincidan por nombre/autor
    $songs = Song::with('categories')
        ->where('name', 'LIKE', "%{$query}%")
        ->orWhere('autor', 'LIKE', "%{$query}%")
        ->orWhereHas('categories', function ($q) use ($categories) {
            $q->whereIn('id', $categories);
        })
        ->limit(10) // Opcional: limitar resultados
        ->get();

    return response()->json($songs);
}
}