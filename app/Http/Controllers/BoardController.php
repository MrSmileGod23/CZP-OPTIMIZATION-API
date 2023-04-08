<?php

namespace App\Http\Controllers;

use App\Models\Pass;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function guard(){
        if ($pass = Pass::where('status','Прибыл')->get()){
            return response()->json(['data' => [
                'code' => 200,
                'message' => 'Прибывшие машины',
                'drivers' => $pass->pluck('CarNumber')->toArray()
            ]], 200);
        }else{
            return response()->json(['errors' => [
                'code' => 403,
                'message' => 'Отсутсвуют машины'
            ]], 403);
        }
    }

    public function storekeeper(){

    }
}
