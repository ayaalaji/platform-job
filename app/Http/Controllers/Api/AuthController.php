<?php

namespace App\Http\Controllers\Api;

// use Auth;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Psy\Command\WhereamiCommand;

class AuthController extends Controller
{
    public function register(Request $request){
      $post_data = $request->validate([
          'name'=>'required|string',
          'email'=>'required|string|email|unique:users',
          'password'=>'required|min:8',
          
        ]);

        $user = User::create([
           'name' => $post_data['name'],
           'email' => $post_data['email'],
           'password' => Hash::make($post_data['password']),
           'role' => ["User"]
        ]);

   
        $user->assignRole(["User"]);
        $token = $user->createToken('authToken')->plainTextToken;
         return response()->json([
           'access_token' => $token,
           'token_type' => 'Bearer',
        ]);
    }
    public function login(LoginRequest $request){
        $user = User::where('email', $request['email'])->firstOrFail();
        if (in_array('Manager', $user->role)) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return response()->json([
                   'message' => 'Invalid login details'
                ], 401);
        }
        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json([
               'access_token' => $token,
               'token_type' => 'Bearer',
               'company_id' => $user->company_id,
               'company_name' => $user->company->name,
               'company_logo' => $user->company->logo,
               'company_color' => $user->company->color,
       ]);
        }
        else{
            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return response()->json([
                   'message' => 'Invalid login details'
                ], 401);
            }
            $token = $user->createToken('authToken')->plainTextToken; 
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'company_id' => 'you are just user..you do not belong to any company',
            ]);
        }
}

 public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
    
}