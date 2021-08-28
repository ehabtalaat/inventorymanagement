<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
class AuthController extends Controller
{
    public function signin(Request $request)
    {
       $request->validate([
        'name' => 'required',
         'password' => 'required']);
        $credentials = $request->only(['name', 'password']);

        if (! $token = auth()->guard('api')->attempt($credentials)) {
        return response()->json(['errors' =>  [ 'error'=> 'Email or Password Invalid']], 401);
        }
   else{
          return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
      }
    }public function signup(Request $request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['status' => true]);
    }  public function user(Request $request)
    {
        $user = User::find(auth()->user()->id);
        return response()->json(['data' => $user]);
    }
}
