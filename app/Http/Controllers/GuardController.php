<?php

namespace App\Http\Controllers;

use App\Models\Pass;
use Illuminate\Http\Request;

class GuardController extends Controller
{
    public function index(){
        if ($pass = Pass::where('status',['Отсутствует','Прибыл'])->get()){
            return response()->json(['data' => [
                'code' => 200,
                'message' => 'Все пропуска',
                'passes' => $pass
            ]], 200);
        }
    }

    public function switch(Request $request){
        if ($pass = Pass::where(['PassNumber' => $request->PassNumber])->first()){
            if ($pass -> status === 'Отсутствует'){
                if($pass -> status = 'Прибыл'){
                    $pass->save();
                    return response()->json(['data' => [
                        'code' => 200,
                        'message' => 'Статус был поменян на Прибыл',
                        'passNumber' => $pass -> PassNumber,
                        'status' => $pass -> status
                    ]], 200);
                }
            }else if ($pass -> status === 'Прибыл'){
                if($pass -> status = 'Ожидание'){
                    $pass->save();
                    return response()->json(['data' => [
                        'code' => 200,
                        'message' => 'Статус был поменян на Ожидание',
                        'passNumber' => $pass -> PassNumber,
                        'status' => $pass -> status
                    ]], 200);
                }
            }
        }else{
            return response()->json(['error' => [
                'code' => 403,
                'message' => 'Пропуск не найден',

            ]], 403);
        }
    }
}
