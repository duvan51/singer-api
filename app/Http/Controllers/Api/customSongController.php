<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomSong;
use App\Models\Song;



class customSongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'repertorio_id' => 'required|exists:repertorios,id',
            'song_id' => 'required|exists:song,id',
            'repertorio_song_category_id' => 'nullable|exists:repertorio_song_category,id',
        ]);
       
        
        $original = Song::findOrFail($request->song_id);

        $customSong = CustomSong::create([
            'repertorio_id' => $request->repertorio_id,
            'original_song_id' => $original->id,
            'repertorio_song_category_id' => $request->repertorio_song_category_id,
            'title' => $original->name,
            'lyrics' => json_encode($original->song),
            'key' => '',
        ]);

        return response()->json($customSong, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    $customSong = CustomSong::find($id);

    if (!$customSong) {
        return response()->json([
            'message' => 'Canción personalizada no encontrada',
            'status' => 404
        ], 404);
    }

    return response()->json($customSong, 200);
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
