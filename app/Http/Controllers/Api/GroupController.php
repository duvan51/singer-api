<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class GroupController extends Controller{

    
    
    public function store(Request $request){
    try {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'members' => 'nullable|array',
            'members.*' => 'email'
        ]);


        $group = Group::create([
            'nombre' => $request->nombre,
            'fecha' => $request->fecha,
            'user_id' => $request->user_id,
        ]);

        $memberIds=[];
        if(!empty($request->members)){
            $memberIds = User::whereIn('email', $request->members)->pluck('id')->toArray();
        }
        $memberIds[] = $request->user_id;
        $group->users()->sync(array_unique($memberIds));
        
        return response()->json($group->load(['users', 'repertorios']), 201);

        

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



    public function index(){
        $groups = Group::with('users')->get();
        if($groups->isEmpty()){
            return response()->json([
                'message' => 'No se encontraron grupos',
                'status' => 404
             ], 404);
        }

        return response()->json($groups->load(['users', 'repertorios']), 200);
    }


    
    public function show($id){
        $groups = Group::with('users')->find($id);
        if(!$groups){
            $data = [
                'message' => 'Grupo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($groups->load(['users', 'repertorios']), 200);
    }



}
