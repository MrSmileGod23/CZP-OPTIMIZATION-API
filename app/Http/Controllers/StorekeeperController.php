<?php

namespace App\Http\Controllers;

use App\Models\WaitingDriver;
use Illuminate\Http\Request;

class StorekeeperController extends Controller
{
    public function index(){
        if ($drivers = WaitingDriver::all()){
            return response()->json(['data' => [
                'code' => 200,
                'message' => 'Все машины',
                'drivers' => $drivers
            ]], 200);
        }
    }

    public function switch(Request $request)
    {
        if ($pass = WaitingDriver::where(['PassNumber' => $request->PassNumber])->first()) {
            if ($pass->status === 'Ожидание') {
                if (WaitingDriver::destroy($pass->id)) {
                    return response()->json(['data' => [
                        'code' => 200,
                        'message' => 'Был удален'
                    ]], 200);
                } else {
                    return response()->json(['error' => [
                        'code' => 403,
                        'message' => 'Статус не был поменян',
                    ]], 403);
                }
            } else {
                return response()->json(['error' => [
                    'code' => 403,
                    'message' => 'Пропуск не найден',

                ]], 403);
            }
        }
    }
}
