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




    public function store(Request $request){
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
    $category = Category::find($id);

    if (!$category) {
        return response()->json([
            'message' => 'Categoría no encontrada',
            'status' => 404
        ], 404);
    }

    $request->validate([
        'name' => 'nullable|string',
        'image_url' => 'nullable|string'
    ]);

    if (!$request->filled('name') && !$request->filled('image_url')) {
        return response()->json([
            'message' => 'Debes enviar al menos "name" o "image_url" para actualizar.',
            'status' => 400
        ], 400);
    }

    $data=[];
    if($request->filled('name')){
        $data['name'] = $request->input('name');
    }
    if($request->filled('image_url')){
        $data['image_url'] = $request->input('image_url');
    }

    $category->update($data);

    return response()->json([
        'message' => 'Categoría actualizada con éxito',
        'category' => $category
    ], 200);
    
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