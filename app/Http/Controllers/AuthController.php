<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'     => ['required'],
            'email'    => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed']
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // $token = $user->createToken('userToken')->plainTextToken;

        // $response = [
        //     'user'  => $user,
        //     'token' => $token
        // ];

        return response()->json(['message' => 'success'], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response(Auth::user(), 200);
        }

        abort(401);
    }

    // public function logout(Request $request)
    // {
    //     auth()->user()->tokens()->delete();

    //     return [
    //         'message' => 'logged out'
    //     ];
    // }

    // public function login(Request $request)
    // {
        // $request->validate([
        //     'email' => ['required'],
        //     'password' => ['required']
        // ]);

    //     if (Auth::attempt($request->only('email', 'password'))) {
    //         return response()->json(Auth::user(), 200);
    //     }

    //     throw ValidationException::withMessages([
    //         'email' => ['The provided credentials are incorrect']
    //     ]);
    // }

    public function logout()
    {
        Auth::logout();
    }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email'    => ['required', 'email'],
    //         'password' => ['required', 'min:6'],
    //     ]);

    //     // Checking email
    //     $user = User::where('email', $request->email)->first();

    //     // Checking password
    //     if (!$user || !Hash::check($request->password, $user->password)) {
    //         return response([
    //             'msg' => 'wrong password or email'
    //         ], 401);
    //     }            

    //     $token = $user->createToken('userToken')->plainTextToken;

    //     $response = [
    //         'user'  => $user,
    //         'token' => $token
    //     ];

    //     return response($response, 201);
    // }
}
