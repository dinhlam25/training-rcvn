<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Passport;

class AuthController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User 
     */
    public function hello()
    {
        return response()->json(
            [
                'id' => 1,
                'title' => 'love y',
                'mes' => 'dinhlam'
            ],
        );
    }

    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login','register']]);
    // }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');


        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('passport OA', ['check-status', 'only-read'])->accessToken;
        // $token = $user->createToken('sanctum token',['onlyread'])->plainTextToken;
        return response()->json([
            'status' => 'success',
            'token' => $token,
            'type' => 'bearer by passport',
            // 'user' => $user,

        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => $request->password,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout(Request $request)
    {
        // auth('web')->logout();
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

            // 'token' => Auth::refresh(),
            'token' => Passport::refreshToken(),
            'type' => 'bearer',

        ]);
    }
    public function getMe()
    {
        $user = Auth::user();
        return response()->json($user, 200);
    }
}
