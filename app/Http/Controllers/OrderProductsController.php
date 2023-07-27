<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderProducts;

class OrderProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $oproducts = OrderProducts::all();
        return response()->json($oproducts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|numeric', 
        ]);
        
        $oproducts = new OrderProducts([
            'order_id' => $request->input('order_id'),
            'product_id' => $request->input('product_id'),
            'quantity' =>  $request->input('quantity'),
        ]);

        $oproducts->save();

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
         // Validar los datos enviados desde la solicitud
         $request->validate([
            'quantity' => 'required|numeric', 
                //'user_id' => 'required',
        ]);

       
        $oproducts = OrderProducts::find($id);

        
        if (!$oproducts) {
            return response()->json(['message' => 'Orden no encontrado'], 404);
        }

        
        $oproducts->quantity = $request->input('quantity');
        
      //  $user->user_id = $request->input('user_id');

       

        $oproducts->save();

        return response()->json(['message' => 'Orden actualizada con éxito'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $oproducts = OrderProducts::find($id);

        
        if (!$oproducts) {
            return response()->json(['message' => 'Orden no encontrada'], 404);
        }

        // Eliminar el usuario
        $oproducts->delete();

        return response()->json(['message' => 'Orden eliminada con éxito'], 200); 
    }
}
