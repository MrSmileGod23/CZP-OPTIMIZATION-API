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
            'PassNumber' =>"5000000".''.fake()->biasedNumberBetween(min:1000,max: 20000),
            'CarNumber' => fake()->randomElement($array = array ('А', 'В', 'Е', 'К', 'М', 'Н', 'О', 'Р', 'С', 'Т', 'У', 'Х')).''.fake()->randomDigit().''.fake()->randomDigit().''.fake()->randomDigit().''.fake()->randomElement($array = array ('А', 'В', 'Е', 'К', 'М', 'Н', 'О', 'Р', 'С', 'Т', 'У', 'Х')).''.fake()->randomElement($array = array ('А', 'В', 'Е', 'К', 'М', 'Н', 'О', 'Р', 'С', 'Т', 'У', 'Х')).''.fake()->randomElement($array = array ('74','174','774')),
            'FIO' =>fake()->lastName.' '.fake()->firstNameMale().' '.fake()->middleNameMale() ,
            'SenderName' => fake()->randomElement($array = array ('ДЛЗ ООО','КАРАБАШМЕДЬ АО','ММК-ЛМЗ ООО','ТОЧИНВЕСТ ЦИНК ООО','СУМЗ АО')),
            'CheckpointNumber' => 'КПП № 6' ,
            'ProductType' => fake()->randomElement($array = array ('ЦИНК ЦВ0 ПАКЕТ','КЛИНКЕР','СПЛАВ ЦА04 БЛОК 1Т','СПЛАВ ЦА08 БЛОК 1Т','СПЛАВ ЦА06 БЛОК 1Т')),
            'ProductVolume' => fake()->biasedNumberBetween(min: 1,max: 200),
            'MetricUnit' => fake()->randomElement($array = array ('КГ','Т')),
            'status' => fake()->randomElement($array = array ('Отсутствует'))
        ];
    }
}
