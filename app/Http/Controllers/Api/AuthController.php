<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    /*
    {
    "status_code": 200,
    "access_token": "1|bsBqbhCPaEXjmg4w3BPpR6dh3LmSAjznZLJDb918",
    "token_type": "Bearer"
}
    */
    public function login(Request $request){
       try{
        //    $request->validate([
        //        'email' => 'email|required',
        //        'password' => 'required'
        //    ]);
           $credentials = request(['email', 'password']);
           if(!Auth::attempt($credentials)){
               return response()->json([
                   'status_code' => 500,
                   'message' => 'Unauthorized'
               ]);
           }
           $user = Auth::user();
           $tokenResult = $user->createToken('authToken')->plainTextToken;
           return response()->json([
               'status_code' => 200,
               'access_token' => $tokenResult,
               'token_type' => 'Bearer'
           ]);
       }catch(Exception $error){
           return response()->json([
               'status_code' => 500,
               'message' => 'Error in login',
               'error' => $error
           ]);
       }
    }

    public function register(AuthRequest $request){
        try{
         // validated returns all the data validated
            $validated = $request->validated();
          
            $user = new User;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->name =  $request->name;
            $user->save();
            return response()->json(['status' => 'success'], 200);
        }catch(Exception $error){
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in register',
                'error' => $error
            ]);
        }
     }
}
