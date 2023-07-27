<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use Illuminate\Http\Request;

class UserDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $udetails = UserDetail::all();
        return response()->json($udetails);
    }

    /**
     * Show the form for creating a new resource.
     */
        public function create(Request $request)
        {
            $request->validate([
                'address' => 'required|string',
                'phone_number' => 'required|string',
                'user_id' => 'required',
            ]);
            // Crear el usuario en la base de datos
            $user = new UserDetail([
                'address' => $request->input('address'),
                'phone_number' => $request->input('phone_number'),
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
        $udetail = UserDetail::with('user')->findOrFail($id);
        return response()->json($udetail);
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
            'address' => 'required|string',
                'phone_number' => 'required|string',
                //'user_id' => 'required',
        ]);

        // Buscar al usuario por su ID
        $user = UserDetail::find($id);

        // Si el usuario no existe, devolver una respuesta de error
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // Actualizar la información del usuario
        $user->address = $request->input('address');
        $user->phone_number = $request->input('phone_number');
      //  $user->user_id = $request->input('user_id');

       

        $user->save();

        return response()->json(['message' => 'Usuario actualizado con éxito'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = UserDetail::find($id);

        // Si el usuario no existe, devolver una respuesta de error
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // Eliminar el usuario
        $user->delete();

        return response()->json(['message' => 'Usuario eliminado con éxito'], 200); 
    }
}
