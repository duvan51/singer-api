<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Song;
use Illuminate\Http\Client\ResponseSequence;

class songController extends Controller
{
    public function index(){
        
        $songs = Song::all();
        if($songs -> isEmpty()){
            $data = [
                'message' => 'no se encontraron canciones',
                'status' => 200
            ];
            return response()->json($data, 404);
        };

        return response()->json($songs, 200);
    }


    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'autor' => 'required',
            'song' => 'required',
        ]);
        if($validator -> fails()){
            $data = [
                'message' => 'erorr al validar los datos',
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
                'message' => 'erorr al crear la cancion',
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
