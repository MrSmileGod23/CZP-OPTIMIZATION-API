<?php

namespace App\Http\Controllers;

use App\Models\Pass;
use App\Models\WaitingDriver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuardController extends Controller
{
    public function drivers(){
        $count = DB::table('waiting_drivers')->count();
        return response()->json(['data' => [
            'code' => 200,
            'message' => 'Кол-во машин на стоянке',
            'count' => $count ,
        ]], 200);
    }
    public function index(){
        if ($pass = Pass::where('status','Отсутствует')->orWhere('status','Прибыл')->get()){
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
                }else{
                    return response()->json(['error' => [
                        'code' => 403,
                        'message' => 'Статус не был поменян',
                    ]], 403);
                }
            }else if ($pass -> status === 'Прибыл'){
                $count = DB::table('waiting_drivers')->count();
                if ($count < 7) {
                    if ($pass->status = 'Ожидание' and WaitingDriver::create([
                            'PassNumber' => $pass->PassNumber,
                            'CarNumber'=> $pass->CarNumber,
                            'FIO' => $pass->FIO,
                            'SenderName' => $pass->SenderName,
                            'CheckpointNumber' => $pass->CheckpointNumber,
                            'ProductType' => $pass->ProductType,
                            'ProductVolume' => $pass->ProductVolume,
                            'MetricUnit' => $pass->MetricUnit,
                            'status' => $pass->status
                        ])) {
                        $pass->save();
                        return response()->json(['data' => [
                            'code' => 200,
                            'message' => 'Статус был поменян на Ожидание',
                            'passNumber' => $pass->PassNumber,
                            'status' => $pass->status
                        ]], 200);
                    } else if ($pass->status = 'Ожидание') {
                        return response()->json(['error' => [
                            'code' => 403,
                            'message' => 'Статус не был поменян',
                        ]], 403);
                    }
                }
                else{
                    return response()->json(['error' => [
                        'code' => 403,
                        'message' => 'В очереди уже 7 водителей',
                    ]], 403);
                }
            }else{
                return response()->json(['error' => [
                    'code' => 403,
                    'message' => 'Уже стоит статус Ожидание',
                ]], 403);
            }
        }else{
            return response()->json(['error' => [
                'code' => 403,
                'message' => 'Пропуск не найден',

            ]], 403);
        }
    }
}
