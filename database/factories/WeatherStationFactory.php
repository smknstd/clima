<?php

namespace Database\Factories;

use App\Models\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WeatherStationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => "Station installée dans un jardin particulier et sur le toit d'une maison dan sun lotissement",
            'creation_date' => "Janvier 1997",
            'city' => "Haegen",
            'altitude' => "355",
            'postal_code' => "67700",
            'hardware_details' => "Vantage Pro 2",
            'website_url' => "https://www.meteociel.fr/station/198523",
        ];
    }
}
