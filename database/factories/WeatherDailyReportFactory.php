<?php

namespace Database\Factories;

use App\Models\Enums\WindDirection;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeatherDailyReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'date' => today(),
        'min_temperature' => 1210,
        'max_temperature' => 1210,
        'pressure' => 1210,
        'min_pressure' => 1210,
        'max_pressure' => 1210,
        'precipitation' => 1210,
        'sunshine_duration' => 1210,
        'wind_direction' => WindDirection::ENE,
        'avg_wind_speed' => 1210,
        'max_wind_speed' => 1210,
        'has_rain' => false,
        'has_storm' => false,
        'has_hail' => false,
        'has_snow' => false,
        'has_fog' => false,
        'has_flood' => false,
        'comment' => "Très beau soleil, un peu de brume le matin",
        ];
    }
}
