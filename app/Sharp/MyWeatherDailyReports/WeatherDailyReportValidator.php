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
            "date.required" => "La date du relev?? est obligatoire",
            "min_temperature.numeric" => "D??sol??, cela ne correspond pas au format attendu. Veuillez saisir une temp??rature en ??c en utilisant le \".\" et non pas une \",\" s'il y a une d??cimale.",
            "min_temperature.min" => "La temp??rature doit ??tre sup??rieure ?? -40??c",
            "min_temperature.max" => "La temp??rature doit ??tre inf??rieure ?? 55??c",
            "min_temperature.regex" => "D??sol??, cela ne correspond pas au format attendu. Veuillez saisir une temp??rature en ??c en utilisant le \".\" et non pas une \",\" s'il y a une d??cimale.",
            "max_temperature.numeric" => "D??sol??, cela ne correspond pas au format attendu. Veuillez saisir une temp??rature en ??c en utilisant le \".\" et non pas une \",\" s'il y a une d??cimale.",
            "max_temperature.min" => "La temp??rature doit ??tre sup??rieure ?? -40??c",
            "max_temperature.max" => "La temp??rature doit ??tre inf??rieure ?? 55??c",
            "max_temperature.regex" => "D??sol??, cela ne correspond pas au format attendu. Veuillez saisir une temp??rature en ??c en utilisant le \".\" et non pas une \",\" s'il y a une d??cimale.",
            "max_wind_speed.numeric" => "D??sol??, cela ne correspond pas au format attendu. Veuillez saisir une vitesse en km/h en utilisant le \".\" et non pas une \",\" s'il y a une d??cimale.",
            "max_wind_speed.min" => "La vitesse doit ??tre sup??rieure ?? 0",
            "max_wind_speed.max" => "La vitesse doit ??tre inf??rieure ?? 300 km/h",
            "max_wind_speed.regex" => "D??sol??, cela ne correspond pas au format attendu. Veuillez saisir une vitesse en km/h en utilisant le \".\" et non pas une \",\" s'il y a une d??cimale.",
            "avg_wind_speed.numeric" => "D??sol??, cela ne correspond pas au format attendu. Veuillez saisir une vitesse en km/h en utilisant le \".\" et non pas une \",\" s'il y a une d??cimale.",
            "avg_wind_speed.min" => "La vitesse doit ??tre sup??rieure ?? 0",
            "avg_wind_speed.max" => "La vitesse doit ??tre inf??rieure ?? 300 km/h",
            "avg_wind_speed.regex" => "D??sol??, cela ne correspond pas au format attendu. Veuillez saisir une vitesse en km/h en utilisant le \".\" et non pas une \",\" s'il y a une d??cimale.",
            "sunshine_duration.numeric" => "D??sol??, cela ne correspond pas au format attendu. Veuillez saisir une dur??e en heures en utilisant le \".\" et non pas une \",\" s'il y a une d??cimale.",
            "sunshine_duration.min" => "La dur??e doit ??tre sup??rieure ?? 0",
            "sunshine_duration.max" => "La dur??e doit ??tre inf??rieure ?? 24",
            "sunshine_duration.regex" => "D??sol??, cela ne correspond pas au format attendu. Veuillez saisir une dur??e en heures en utilisant le \".\" et non pas une \",\" s'il y a une d??cimale.",
            "min_pressure.integer" => "La valeur doit un ??tre un nombre entier",
            "min_pressure.min" => "La valeur doit ??tre sup??rieure ?? 0",
            "min_pressure.max" => "La valeur doit ??tre inf??rieure ?? 2000",
            "max_pressure.integer" => "La valeur doit un ??tre un nombre entier",
            "max_pressure.min" => "La valeur doit ??tre sup??rieure ?? 0",
            "max_pressure.max" => "La valeur doit ??tre inf??rieure ?? 2000",
            "pressure.integer" => "La valeur doit un ??tre un nombre entier",
            "pressure.min" => "La valeur doit ??tre sup??rieure ?? 0",
            "pressure.max" => "La valeur doit ??tre inf??rieure ?? 2000",
            "snow_depth.integer" => "La valeur doit un ??tre un nombre entier",
            "snow_depth.min" => "La valeur doit ??tre sup??rieure ?? 0",
            "snow_depth.max" => "La valeur doit ??tre inf??rieure ?? 2000",
            "precipitation.integer" => "La valeur doit un ??tre un nombre entier",
            "precipitation.min" => "La valeur doit ??tre sup??rieure ?? 0",
            "precipitation.max" => "La valeur doit ??tre inf??rieure ?? 2000",
        ];
    }
}


