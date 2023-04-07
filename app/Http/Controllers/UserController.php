<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request){

        $validator=Validator::make($request->all(),[
            'login' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails())
            return response()->json(['errors' => [
                'code' => 422,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ]], 422);

        if ($user = User::where(['login' => $request->login])->first()
            and Hash::check($request->password, $user->password)) {
            return response()->json([
                'id'=>$user->id,
                'token' => $user->generateToken()
            ], 200);
        }

    }
}
