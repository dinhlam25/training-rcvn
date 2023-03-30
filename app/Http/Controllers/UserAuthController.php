<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\User\UserResource;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
    public function index(Request $request)
    {
        // dd($request->all());
        $user = User::query();

        if ($request->filled('name')) {
            $user->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->filled('email')) {
            $user->where('email', 'LIKE', '%' . $request->email . '%');
        }

        if ($request->filled('group')) {
            $user->where('department', '=', $request->group);
        }

        if ($request->filled('status')) {
            $user->where('is_active', '=', $request->status);
        }


        $user = $user->where('is_delete',0)
                    ->paginate(10);
        return UserResource::collection($user);

        return response()->json([
            "success" => false,
            "errors" => "khong tim thay user"
        ]);
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
        $token = $user->createToken('passport OA', ['editor', 'reviewer'])->accessToken;
        // dd($request->isRememberMe);

        if($request->isRememberMe){
            $user->remember_token = $token;
            $user->save();
        }  else {
            $user->remember_token = null;
            $user->save();
        }

        $user->last_login_at = Carbon::now()->format('Y-m-d H:i:s');
        $user->last_login_ip = $request->ip() ;
        $user->save();

        // $token = $user->createToken('sanctum token',['onlyread'])->plainTextToken;
        return response()->json([
            'status' => 'success',
            'token' => $token,
            'user' => $user,
            'type' => 'bearer by passport',

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
    public function create(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('04092001'),
            'department' => $request->group,
            'is_active' => $request->status === 'Active' ? 1 : 0
        ]);
        if ($user) {
            $user->refresh();
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'group' => $user->department,
                    'last_login' => $user->last_login_at,
                    'is_active' => $user->is_active,
                ]
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'User created failed',
            ]);
        }
    }

    public function update(Request $request, User $user){
        $user = User::where('email',$request->email)->first();
        $user->update([
                        'name' => $request->name ,
                        'email' => $request->email ,
                        'department' => $request->group ,
                        'is_active' => $request->status === 'Active'? 1 : 0,
                        // 'last_login' => $user->last_login_at,
                        // 'is_delete' => $request->is_delete
                    ]);
        
        if ($user) {
            $user->refresh();
            return response()->json([
                'status' => 'success',
                'message' => 'User update successfully',
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'group' => $user->department,
                    'last_login' => $user->last_login_at,
                    'is_active' => $user->is_active,
                ]
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'User update failed',
            ]);
        }
    }
    public function disable(Request $request, $id){
        $user = User::find($id);
     
        if(empty($user)){
            return response()->json([
                "success" => false,
                "massage" => "Tài khoản không tồn tại."
            ]);
        }
        $user->is_delete = 1;
        $result = $user->save();
        if (!$result) {
            return response()->json([
                "success" => false,
                "errors" => "Đã có lỗi xảy ra trong quá trình vận hành!!"
            ]);
        }

        return response()->json(
            [
                'success' => true,
                'errors' => "Đã thành công vô hiệu quá Khách hàng có ID = " . $user->id
            ]
        );
    }

    // public function logout(Request $request)
    // {
    //     // auth('web')->logout();
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Successfully logged out',
    //     ]);
    // }

    // public function refresh()
    // {
    //     return response()->json([
    //         'status' => 'success',
    //         'user' => Auth::user(),

    //         // 'token' => Auth::refresh(),
    //         'token' => Passport::refreshToken(),
    //         'type' => 'bearer',

    //     ]);
    // }
}
