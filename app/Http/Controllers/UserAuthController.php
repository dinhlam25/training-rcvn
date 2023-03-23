<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserOverviewCollection;
use App\Http\Resources\UserResource;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Passport;

class UserAuthController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User 
     */
    //  public function __construct()
    //  {
    //      $this->middleware('auth:api', ['except' => ['login','register']]);
    //  }
    public function hello(Request $request)
    {
        $check = User::get()->count();
        if ($check === 0) {
            return response()->json([
                "success" => false,
                "errors" => "Danh sách người dùng hiện đang trống."
            ]);
        }

        $users = User::paginate(10);
        return UserResource::collection($users);
    }

    public function login(LoginRequest $request)
    {
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
            'user' => $user,
            'type' => 'bearer by passport',
            // 'user' => $user,

        ]);
    }

    public function register(RegisterRequest $request)
    {

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
            // 'authorisation' => [
            //     'token' => $token,
            //     'type' => 'bearer',
            // ]
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

    // public function filter(Request $request)
    // {
    //     $user = User::query()
    //         ->whereName($request->name)
    //         ->email($request)
    //         ->group($request)
    //         ->status($request);

    //     $user = $this->filters($request);
    //     return response()->json([
    //         'user' => $user
    //     ]);
    // }

    public function filter(Request $request)
    {
        // dd($request->all());
        $user = User::query();

        if ($request->filled('name')) {
            $user->where('name', 'LIKE', '%' . $request->name . '%');
                
        }
        if($request->filled('email')){
            $user->where('email', 'LIKE', '%' . $request->email . '%');
        }

        if($request->filled('group')){
            $user->where('department','=',$request->group);
        }

        if($request->filled('status')){
            $user->where('is_active','=',$request->status);
        }

        $user = $user->paginate(10);
        return UserResource::collection($user);

        return response()->json([
            "success" => false,
            "errors" => "khong tim thay user"
        ]);
    }
}
