<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(Request $request){

        $validator=Validator::make($request->all(),[
            'login' => 'required',
            'password' => 'required'
        ]);

            if ($user = User::where(['login' => $request->login], ['password' => $request->password])->first()) {
                return response()->json([
                    'token' => $user->generateToken()
                ], 200);
            }else{
                return response()->json(['errors' => [
                    'code' => 403,
                    'message' => 'Логин или пароль неправильный',
                ]], 403);
            }

        if ($validator->fails()){
            return response()->json(['errors' => [
                'code' => 422,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ]], 422);
        }



    }
}
