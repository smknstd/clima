<?php

namespace App\Sharp\WeatherStation;

use App\Models\Enums\UserRole;
use Code16\Sharp\Form\Validator\SharpFormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class WeatherStationValidator extends SharpFormRequest
{
    public function rules(): array
    {
        return [
            "name" => [
                "required",
                "max:300",
            ],
            "description" => [
                "max:2000",
            ],
            "city" => [
                "required",
                "max:300",
            ],
            "postal_code" => [
                "required",
                "numeric",
            ],
            "altitude" => [
                "nullable",
                "numeric",
            ],
            "creation_date" => [
                "max:300",
            ],
            "hardware_details" => [
                "max:1000",
            ],
        ];
    }
}


