<?php

namespace App\Http\Controllers;

use App\Models\Pass;
use Illuminate\Http\Request;

class EconomistController extends Controller
{
    public function store(){

        $pass = [
            'PassNumber' =>'5000000429570',
            'CarNumber' => 'В029МХ/797',
            'FIO' => 'Коновалов Богдан Алексеевич',
            'SenderName' => 'ДЛЗ ООО',
            'CheckpointNumber' => 'КПП № 6' ,
            'ProductType' => 'ЦИНК ЦВ0 ПАКЕТ',
            'ProductVolume' => '20000' ,
            'MetricUnit' => 'Т' ,
        ];
        if (Pass::create($pass)){
            return response()->json(['data' => [
                'code' => 200,
                'message' => 'Пропуск успешно добавлен'
            ]], 200);
        }
    }
}
