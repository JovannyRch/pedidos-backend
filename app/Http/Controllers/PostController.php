<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    /**
     * Show the form for creating a new resource.
     */

     
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required',
            'user_id' => 'required',
        ]);

        // Crear el usuario en la base de datos
        $user = new Post([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' =>  $request->input('user_id'),
        ]);

        $user->save();

        return response()->json(['message' => 'Usuario creado con éxito'], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with('user')->findOrFail($id);
        return response()->json($post);
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
