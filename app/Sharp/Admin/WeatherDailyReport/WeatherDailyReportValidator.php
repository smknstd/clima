<?php

namespace App\Sharp\Admin\WeatherDailyReport;

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
        ];
    }

    public function messages()
    {
        return [
            "min_temperature.numeric" => "Désolé, cela ne correspond pas au format attendu. Veuillez saisir une température en °c en utilisant le \".\" et non pas une \",\" s'il y a une décimale.",
            "min_temperature.min" => "La température doit être supérieure à -40°c",
            "min_temperature.max" => "La température doit être inférieure à 55°c",
            "min_temperature.regex" => "Désolé, cela ne correspond pas au format attendu. Veuillez saisir une température en °c en utilisant le \".\" et non pas une \",\" s'il y a une décimale.",
        ];
    }
}


