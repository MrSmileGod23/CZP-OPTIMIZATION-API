<?php

namespace App\Http\Controllers;

use App\Models\Pass;
use Illuminate\Http\Request;

class EconomistController extends Controller
{

    public function store(){

        if (Pass::factory()->create()){
            return response()->json(['data' => [
                'code' => 200,
                'message' => 'Пропуск успешно добавлен'
            ]], 200);
        }
    }


}
