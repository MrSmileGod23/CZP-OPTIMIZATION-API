<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request){

        $request->validate([
           'login' => 'required',
           'password' => 'required'
        ]);

        if(Auth::attempt($request->only(['login','password']))){
            return 'Успешный вход';
        }
        return 'Логин или пароль неправильный';
    }
}
