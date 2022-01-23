<?php

namespace App\Sharp\MyWeatherDailyReports;

use App\Models\Enums\UserRole;
use Code16\Sharp\Form\Validator\SharpFormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class WeatherDailyReportValidator extends SharpFormRequest
{
    public function rules(): array
    {
        return [
            "date" => [
                "required",
                "date",
                Rule::unique('weather_daily_reports', 'date')->where('weather_station_id', currentSharpRequest()->instanceId()),
            ],
            "min_temperature" => [
                "nullable",
                'numeric',
                'min:-40.00',
                'max:55.00',
                'regex:/^[\-]?\d+(\.\d{1,2})?$/'
            ],
            "max_temperature" => [
                "nullable",
                'numeric',
                'min:-40.00',
                'max:55.00',
                'regex:/^[\-]?\d+(\.\d{1,2})?$/'
            ],
            "avg_wind_speed" => [
                "nullable",
                'numeric',
                'min:0.00',
                'max:300.00',
                'regex:/^[\-]?\d+(\.\d{1,2})?$/'
            ],
            "max_wind_speed" => [
                "nullable",
                'numeric',
                'min:0.00',
                'max:300.00',
                'regex:/^[\-]?\d+(\.\d{1,2})?$/'
            ],
            "sunshine_duration" => [
                "nullable",
                'numeric',
                'min:0.00',
                'max:24.00',
                'regex:/^[\-]?\d+(\.\d{1,2})?$/'
            ],
            "snow_depth" => [
                "nullable",
                "integer",
                'min:0',
                'max:2000',
            ],
            "precipitation" => [
                "nullable",
                "integer",
                'min:0',
                'max:2000',
            ],
            "pressure" => [
                "nullable",
                "integer",
                'min:0',
                'max:2000',
            ],
            "min_pressure" => [
                "nullable",
                "integer",
                'min:0',
                'max:2000',
            ],
            "max_pressure" => [
                "nullable",
                "integer",
                'min:0',
                'max:2000',
            ],
        ];
    }

    public function messages()
    {
        return [
            "date.required" => "La date du relevé est obligatoire",
            "min_temperature.numeric" => "Désolé, cela ne correspond pas au format attendu. Veuillez saisir une température en °c en utilisant le \".\" et non pas une \",\" s'il y a une décimale.",
            "min_temperature.min" => "La température doit être supérieure à -40°c",
            "min_temperature.max" => "La température doit être inférieure à 55°c",
            "min_temperature.regex" => "Désolé, cela ne correspond pas au format attendu. Veuillez saisir une température en °c en utilisant le \".\" et non pas une \",\" s'il y a une décimale.",
            "max_temperature.numeric" => "Désolé, cela ne correspond pas au format attendu. Veuillez saisir une température en °c en utilisant le \".\" et non pas une \",\" s'il y a une décimale.",
            "max_temperature.min" => "La température doit être supérieure à -40°c",
            "max_temperature.max" => "La température doit être inférieure à 55°c",
            "max_temperature.regex" => "Désolé, cela ne correspond pas au format attendu. Veuillez saisir une température en °c en utilisant le \".\" et non pas une \",\" s'il y a une décimale.",
            "max_wind_speed.numeric" => "Désolé, cela ne correspond pas au format attendu. Veuillez saisir une vitesse en km/h en utilisant le \".\" et non pas une \",\" s'il y a une décimale.",
            "max_wind_speed.min" => "La vitesse doit être supérieure à 0",
            "max_wind_speed.max" => "La vitesse doit être inférieure à 300 km/h",
            "max_wind_speed.regex" => "Désolé, cela ne correspond pas au format attendu. Veuillez saisir une vitesse en km/h en utilisant le \".\" et non pas une \",\" s'il y a une décimale.",
            "avg_wind_speed.numeric" => "Désolé, cela ne correspond pas au format attendu. Veuillez saisir une vitesse en km/h en utilisant le \".\" et non pas une \",\" s'il y a une décimale.",
            "avg_wind_speed.min" => "La vitesse doit être supérieure à 0",
            "avg_wind_speed.max" => "La vitesse doit être inférieure à 300 km/h",
            "avg_wind_speed.regex" => "Désolé, cela ne correspond pas au format attendu. Veuillez saisir une vitesse en km/h en utilisant le \".\" et non pas une \",\" s'il y a une décimale.",
            "sunshine_duration.numeric" => "Désolé, cela ne correspond pas au format attendu. Veuillez saisir une durée en heures en utilisant le \".\" et non pas une \",\" s'il y a une décimale.",
            "sunshine_duration.min" => "La durée doit être supérieure à 0",
            "sunshine_duration.max" => "La durée doit être inférieure à 24",
            "sunshine_duration.regex" => "Désolé, cela ne correspond pas au format attendu. Veuillez saisir une durée en heures en utilisant le \".\" et non pas une \",\" s'il y a une décimale.",
            "min_pressure.integer" => "La valeur doit un être un nombre entier",
            "min_pressure.min" => "La valeur doit être supérieure à 0",
            "min_pressure.max" => "La valeur doit être inférieure à 2000",
            "max_pressure.integer" => "La valeur doit un être un nombre entier",
            "max_pressure.min" => "La valeur doit être supérieure à 0",
            "max_pressure.max" => "La valeur doit être inférieure à 2000",
            "pressure.integer" => "La valeur doit un être un nombre entier",
            "pressure.min" => "La valeur doit être supérieure à 0",
            "pressure.max" => "La valeur doit être inférieure à 2000",
            "snow_depth.integer" => "La valeur doit un être un nombre entier",
            "snow_depth.min" => "La valeur doit être supérieure à 0",
            "snow_depth.max" => "La valeur doit être inférieure à 2000",
            "precipitation.integer" => "La valeur doit un être un nombre entier",
            "precipitation.min" => "La valeur doit être supérieure à 0",
            "precipitation.max" => "La valeur doit être inférieure à 2000",
        ];
    }
}


