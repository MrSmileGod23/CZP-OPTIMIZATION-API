<?php

namespace Database\Factories;

use App\Models\Pass;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pass>
 */
class PassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Pass::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'PassNumber' =>'5000000429570',
            'CarNumber' => 'В029МХ/797',
            'FIO' => 'Коновалов Богдан Алексеевич',
            'SenderName' => 'ДЛЗ ООО',
            'CheckpointNumber' => 'КПП № 6' ,
            'ProductType' => 'ЦИНК ЦВ0 ПАКЕТ',
            'ProductVolume' => '20,500' ,
            'MetricUnit' => 'Т' ,
        ];
    }
}
