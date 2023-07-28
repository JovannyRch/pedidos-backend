<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{

    public function login(Request $request)
    {
        $response = ["status" => 0, "msg" => ""];
        $data = json_decode($request->getContent());
        $user = User::where('email', $data->email)->first();
        if ($user) {
            if (Hash::check($data->password, $user->password)) {
                $token = $user->createToken("example");
                $response["status"] = 1;
                $response["msg"] = $token->plainTextToken;
                $response["user"] = $user;
            } else {
                $response["status"] = 0;
                $response["msg"] = "Credenciales incorrectas.";
            }
        } else {
            $response["msg"] = "Usuario no encontrado.";
        }
        return response()->json($response);
    }


    public function getUserCount()
    {
        $userCount = User::count();
        return response()->json(['user_count' => $userCount]);
    }

    public function getProductCount()
    {
        $productCount = Product::count();
        return response()->json(['product_count' => $productCount]);
    }

    public function getOrderCount()
    {
        $orderCount = Order::count();
        return response()->json(['order_count' => $orderCount]);
    }

    public function getCounts()
    {
        $userCount = User::count();
        $productCount = Product::count();
        $orderCount = Order::count();

        $datesWithOrders = [];
        for ($daysAgo = 6; $daysAgo >= 0; $daysAgo--) {
            $date = \Carbon\Carbon::today()->subDays($daysAgo);

            $orderCount = \App\Models\Order::whereDate('created_at', $date)->count();

            $datesWithOrders[] = [
                'name' => $date->toDateString(),
                'value' => $orderCount,
            ];
        }


        return response()->json(['users' => $userCount, 'products' => $productCount, 'orders' => $orderCount, "orders_last_7_days" => $datesWithOrders]);
    }

    public function addClient(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'token' => 'required|string',
        ]);


        $client = Client::where('name', $request->input('name'))->first();

        if ($client) {
            $client->token = $request->input('token');
            $client->save();
            return response()->json(['message' => 'Cliente actualizado con éxito', "status" => 1], 201);
        }


        $user = new Client([
            'name' => $request->input('name'),
            'token' =>  $request->input('token'),
        ]);

        $user->save();

        return response()->json(['message' => 'Cliente creado con éxito', "status" => 1], 201);
    }
}
