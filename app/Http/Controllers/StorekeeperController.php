<?php

namespace App\Http\Controllers;

use App\Models\WaitingDriver;
use Illuminate\Http\Request;

class StorekeeperController extends Controller
{
    public function index(){
        $smallTrucks = [];
        $bigTrucks = [];
        $trucks = WaitingDriver::all();
        // Разбиваем грузовики на две части: маленькие и большие
        foreach ($trucks as $truck) {
            if ($truck->ProductVolume <= 15000) {
                $smallTrucks[] = $truck;
            } else {
                $bigTrucks[] = $truck;
            }
        }

        // Сортируем каждую часть по тоннажу
        usort($smallTrucks, function ($a, $b) {
            return $a->weight <=> $b->weight;
        });

        usort($bigTrucks, function ($a, $b) {
            return $a->weight <=> $b->weight;
        });

        // Собираем новый массив грузовиков
        $sortedTrucks = [];
        $smallCount = count($smallTrucks);
        $bigCount = count($bigTrucks);
        $i = 0;
        $j = 0;

        while ($i < $smallCount && $j < $bigCount) {
            $sortedTrucks[] = $smallTrucks[$i];
            $sortedTrucks[] = $smallTrucks[$i + 1];
            $sortedTrucks[] = $bigTrucks[$j];
            $i += 2;
            $j++;
        }

        // Добавляем необработанные маленькие грузовики
        while ($i < $smallCount) {
            $sortedTrucks[] = $smallTrucks[$i];
            $i++;
        }
        if ($drivers = WaitingDriver::all()){
            return response()->json(['data' => [
                'code' => 200,
                'message' => 'Все машины',
                'drivers' => $sortedTrucks
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
