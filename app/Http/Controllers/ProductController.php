<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
     
        $request->validate([
            'name' => 'required|string',
        'description' => 'nullable|string', 
        'price' => 'required|numeric', 
        ]);

        
        $product = new Product([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
        ]);

        $product->save();

        return response()->json(['message' => 'Producto creado con éxito'], 201);
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
       // $product = Product::with('product')->findOrFail($id);
       // return response()->json($product);
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
            'name' => 'required|string',
            'description' => 'nullable|string', 
            'price' => 'required|numeric', 
        ]);

        
        $product = Product::find($id);

        
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        // Actualizar la información
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');

     
        

        $product->save();

        return response()->json(['message' => 'Producto actualizado con éxito'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        
        $product->delete();

        return response()->json(['message' => 'Producto eliminado con éxito'], 200);
    }
}
