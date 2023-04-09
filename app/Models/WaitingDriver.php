<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaitingDriver extends Model
{
    use HasFactory;

    protected $fillable = [
        'PassNumber',
        'CarNumber',
        'FIO',
        'SenderName',
        'CheckpointNumber',
        'ProductType',
        'ProductVolume',
        'MetricUnit',
        'status',
        'queue',
        'point'
    ];
    public function sortTrucksByWeight(array $trucks): array
    {
        $smallTrucks = [];
        $bigTrucks = [];

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

        return $sortedTrucks;
    }
}
