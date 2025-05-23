<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comentarios;


class comentariosController extends Controller{


    public function index(){
        $comentarios = Comentarios::all();

        if($comentarios->isEmpty()){
            $data = [
                'message' => 'No se encontraron comentarios',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($comentarios, 200);
    }



    
    public function store(Request $request){
        $request->validate([
            'contenido' => 'required|string',
            'repertorio_id' => 'required|exists:repertorios,id',
        ]);

        $comentario = Comentarios::create([
            'contenido' => $request->input('contenido'),
            'repertorio_id' => $request->input('repertorio_id'),
            'user_id' => $request->input('user_id'),
        ]);

        return response()->json([
            'success' => true,
            'comentario' => $comentario,
            'message' => 'Comentario agregado exitosamente.'
        ]);
    }




    public function destroy(Comentarios $comentario){
        // Verificar si el usuario autenticado es el autor del comentario
        $comentario->delete();

        return redirect()->back()->with('success', 'Comentario eliminado exitosamente.');
    }


}
