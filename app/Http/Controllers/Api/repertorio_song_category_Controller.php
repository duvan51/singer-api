<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RepertorioSongCategory;

class repertorio_song_category_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = RepertorioSongCategory::with('repertorio')->get();
        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'repertorio_id' => 'required|exists:repertorios,id',
        ]);

        $category = RepertorioSongCategory::create($request->all());

        return response()->json($category, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categorias = RepertorioSongCategory::with(['customSongs'])->find($id);
        
        if (!$categorias) {
            return response()->json([
                'message' => 'categorias no encontrado',
                'status' => 404
            ], 404);
        }

        $agrupadas = $categorias->customSongs
        ->groupBy('original_song_id')
        ->map(function ($items, $originalId){
            return[
                'original_song_id' => $originalId,
                'versiones' => $items->values()
            ];
        })
        ->values();

        return response()->json(
        [
        'id' => $categorias->id,
        'nombre' => $categorias->nombre,
        'created_at' => $categorias->created_at,
        'updated_at' => $categorias->updated_at,
        'custom_songs' => $agrupadas 
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
