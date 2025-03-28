<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class categoryController extends Controller // Cambiado a PascalCase
{
    public function index(){
        $categories = Category::all();
        if($categories->isEmpty()){
            $data = [
                'message' => 'No se encontraron categorias',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($categories, 200);
    }

    public function show($id){
        $categories = Category::find($id);
        if(!$categories){
            $data = [
                'message' => 'Canción no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($categories, 200);
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'image_url' => 'required|string|url', // Ahora solo recibe una URL como string
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Error al validar los datos',
            'errors' => $validator->errors(),
            'status' => 400
        ], 400);
    }

    try {
        // Guardar la categoría con la URL de la imagen enviada desde el frontend
        $category = Category::create([
            'name' => $request->name,
            'image_url' => $request->image_url, // Se espera una URL ya generada desde el frontend
        ]);

        return response()->json([
            'category' => $category,
            'status' => 201
        ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error guardando la categoría',
            'error' => $e->getMessage(),
            'status' => 500
        ], 500);
    }
}




    
    public function update(Request $request, $id){
        
        $song = Category::find($id);
        
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
        ]);

         // Actualizar solo `song` sin convertirlo manualmente
        if ($request->has('song')) {
            $song->update([
            'song' => $request->input('song'),
        ]);
        }

        return response()->json([
            'message' => 'Canción actualizada con éxito',
            'song' => $song->song // Laravel ya lo devolverá como array
        ],200);

    }

    public function destroy($id){
        $song = Category::find($id);
        if(!$song){
            return response()->json(['message' => 'Song no encontrada'], 404);
        }
        $song->delete();

        return response()->json(['message' => 'Canción eliminada con éxito -> ', $song], 200);
    }



   
}