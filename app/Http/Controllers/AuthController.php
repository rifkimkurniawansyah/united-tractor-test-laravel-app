<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    // Register
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => [
                'required',
                'email',
                'unique:users',
                function ($attribute, $value, $fail) {
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $fail('The email format is invalid.');
                    }
                }
            ],
            'password' => [
                'required',
                'min:6',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
            ]
        ], [
            'email.email' => 'The email format is invalid.',
            'password.min' => 'The password must be at least 6 characters.',
            'password.regex' => 'The password must include at least one uppercase letter, one lowercase letter, and one digit.'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message'=> $validator->errors()
            ], 400);
        }

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);

        return response()->json([
            'status'=> true,
            'message'=> 'User created successfully',
            'user' => $user,
            "authorisation" => [
                "token"=> $token,
                'type' => 'bearer',
            ]
        ]);
    }

    // Login
    public function login(Request $request){
        // Validasi
        $validator = Validator::make($request->all(),[
            'email' => [
                'required',
                'email'
            ],
            'password' => [
                'required',
                'min:6',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
            ]
        ], [
            'email.email' => 'The email format is invalid.',
            'password.min' => 'The password must be at least 6 characters.',
            'password.regex' => 'The password must include at least one uppercase letter, one lowercase letter, and one digit.'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message'=> $validator->errors()
            ], 400);
        }

        $loginValue = $request->only('email', 'password');
        if (!Auth::attempt($loginValue)) {
            return response()->json([
                'status'=> false,
                'message'=> 'Email or Password Invalid'
            ], 400);
        }

        $user = Auth::user();
        $token = Auth::tokenById($user->id);

        return response()->json([
            'status'=> true,
            'message'=> 'User logged in successfully',
            'user' => $user,
            'token' => $token
        ]);
    }
}
