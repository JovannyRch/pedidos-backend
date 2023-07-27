<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            
            'user_id' => 'required',
        ]);
        // Crear el usuario en la base de datos
        $user = new Order([
            'date' => $request->input('date'),
            
            'user_id' =>  $request->input('user_id'),
        ]);

        $user->save();

        return response()->json(['message' => 'Orden creada con éxito'], 201);
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
        $order = Order::with('user')->findOrFail($id);
        return response()->json($order);
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
         
         $request->validate([
            'date' => 'required|date',
                
        ]);

       
        $user = Order::find($id);

       
        if (!$user) {
            return response()->json(['message' => 'Orden no encontrado'], 404);
        }

        
        $user->date = $request->input('date');
    

       

        $user->save();

        return response()->json(['message' => 'Orden actualizada con éxito'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Order::find($id);

       
        if (!$user) {
            return response()->json(['message' => 'Orden no encontrada'], 404);
        }

        
        $user->delete();

        return response()->json(['message' => 'Orden eliminada con éxito'], 200);
    }
}
