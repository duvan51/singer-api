<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Repertorios;
use Illuminate\Validation\ValidationException;


class repertorioController extends Controller{


    public function index(){
        $repertorios = Repertorios::with('repertorioSongs', 'customSong', 'repertorio_song_category')->get();

        //$repertorios = Repertorios::all();
        if($repertorios->isEmpty()){
            $data = [
                'message' => 'No se encontraron repertorios',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        return response()->json($repertorios, 200);
    }  
    


    public function store(Request $request){
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'group_id' => 'required|exists:group,id',
                'fecha' => 'required|date',
            ]);
    
            $repertorio = Repertorios::create($request->all());
            
    
            return response()->json($repertorio, 201);
            
    
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
            }
        }


        public function show($id){
            $repertorio = Repertorios::with(['repertorioSongs', 'Comentarios.user:id,name,profile_picture', 'customSong', 'repertorio_song_category'])->find($id);

            if (!$repertorio) {
                return response()->json([
                    'message' => 'Repertorio no encontrado',
                    'status' => 404
                ], 404);
            }

            return response()->json($repertorio, 200);
            
        }
    




}
