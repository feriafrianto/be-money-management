<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
                'status' => 'success',
                'user' => $user,
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);

    }

    public function register(Request $request){
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorization' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
    public function profile()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $users = User::find($id);
            return response()->json([
                'status' => 'success',
                'data' => $users
            ],200);
        } else {
            return response()->json([
                'status' => 'error',
                'messege' => 'User not authorized'
            ],401);
        }
    }
    public function profileedit(Request $request){
        if (Auth::check()) {
            $id = Auth::user()->id;
            $users = User::find($id);
            $users->name = $request->name;
            $users->email = $request->email;
            $users->notelp = $request->notelp;
            $users->tglahir = $request->tglahir;
            $users->password = Hash::make($request->password);
            $users->photo = $request->file('photo')->store('photos','public');
            $users->save();

            return response()->json([
                'status' => 'success',
                'message' => 'User berhasil diupdate',
                'data' => $users
            ],200);
        } else {
            return response()->json([
                'status' => 'error',
                'messege' => 'User not authorized'
            ],401);
        }
    }
}
