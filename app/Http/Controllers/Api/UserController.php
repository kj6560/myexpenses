<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(User::all());
    }
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
    public function register(Request $request)
    {
        $is_exist = User::where('email', $request->email)->first();

        if (empty($is_exist)) {
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user->save();
            if (!empty($user)) {
                $token = $user->createToken('my-app-token')->plainTextToken;

                $response = [
                    'user' => $user,
                    'token' => $token
                ];
                return response()->json(['success' => true, 'message' => 'user created successfully'], 200);
            } else {
                return response()->json(['error' => true, 'message' => 'user not created'], 401);
            }
        } else {
            return response()->json(['error' => true, 'msg' => 'user already exist by this email'], 402);
        }
    }
}
