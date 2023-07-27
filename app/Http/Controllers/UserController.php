<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users(Request $request){
        $users = User::all();
        return response()->json($users);
    }
    public function create(Request $request)
    {
        // Validar los datos enviados desde la solicitud
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Crear el usuario en la base de datos
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $user->save();

        return response()->json(['message' => 'Usuario creado con éxito'], 201);
    }
    public function update(Request $request, $id)
    {
        // Validar los datos enviados desde la solicitud
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
        ]);

        // Buscar al usuario por su ID
        $user = User::find($id);

        // Si el usuario no existe, devolver una respuesta de error
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // Actualizar la información del usuario
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Si se proporcionó una nueva contraseña, actualizarla
        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        return response()->json(['message' => 'Usuario actualizado con éxito'], 200);
    }
    public function destroy($id)
    {
        // Buscar al usuario por su ID
        $user = User::find($id);

        // Si el usuario no existe, devolver una respuesta de error
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // Eliminar el usuario
        $user->delete();

        return response()->json(['message' => 'Usuario eliminado con éxito'], 200);
    }
}
