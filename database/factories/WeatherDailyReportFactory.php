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
        'min_temperature' => $this->faker->numberBetween(-1200, 1100),
        'max_temperature' => $this->faker->numberBetween(0, 3600),
        'pressure' => $this->faker->numberBetween(1100, 1300),
        'min_pressure' => $this->faker->numberBetween(1100, 1200),
        'max_pressure' => $this->faker->numberBetween(1200, 1300),
        'precipitation' => $this->faker->numberBetween(0, 120),
        'sunshine_duration' => $this->faker->numberBetween(0, 24),
        'wind_direction' => $this->faker->randomElement([
            WindDirection::N,
            WindDirection::NNE,
            WindDirection::NE,
            WindDirection::ENE,
            WindDirection::E,
            WindDirection::ESE,
            WindDirection::SE,
            WindDirection::SSE,
            WindDirection::S,
            WindDirection::SSW,
            WindDirection::SW,
            WindDirection::WSW,
            WindDirection::W,
            WindDirection::WNW,
            WindDirection::NW,
            WindDirection::NNW,
        ]),
        'avg_wind_speed' => $this->faker->numberBetween(120, 1210),
        'max_wind_speed' => $this->faker->numberBetween( 1000,15000),
        'has_rain' => $this->faker->boolean,
        'has_storm' => $this->faker->boolean,
        'has_hail' => $this->faker->boolean,
        'has_snow' => $this->faker->boolean,
        'has_fog' => $this->faker->boolean,
        'has_flood' => $this->faker->boolean,
        'has_glaze' => $this->faker->boolean,
        'comment' => "Très beau soleil, un peu de brume le matin",
        ];
    }
}
