<?php

namespace App\Models\Enums;

enum WindDirection: string
{
    case N = 'wi-towards-n';
    case NNE = 'wi-towards-nne';
    case NE = 'wi-towards-ne';
    case ENE = 'wi-towards-ene';
    case E = 'wi-towards-e';
    case ESE = 'wi-towards-ese';
    case SE = 'wi-towards-se';
    case SSE = 'wi-towards-sse';
    case S = 'wi-towards-s';
    case SSW = 'wi-towards-ssw';
    case SW = 'wi-towards-sw';
    case WSW = 'wi-towards-wsw';
    case W = 'wi-towards-w';
    case WNW = 'wi-towards-wnw';
    case NW = 'wi-towards-nw';
    case NNW = 'wi-towards-nnw';

    public function label(): string
    {
        return match($this)
        {
            self::N => 'Nord',
            self::NNE => 'Nord-Nord-Est',
            self::NE => 'Nord-Est',
            self::ENE => 'Est-Nord-Est',
            self::E => 'Est',
            self::ESE => 'Est-Sud-Est',
            self::SE => 'Sud-Est',
            self::SSE => 'Sud-Sud-Est',
            self::S => 'Sud',
            self::SSW => 'Sud-Sud-Ouest',
            self::SW => 'Sud-Ouest',
            self::WSW => 'Ouest-Sud-Ouest',
            self::W => 'Ouest',
            self::WNW => 'Ouest-Nord-Ouest',
            self::NW => 'Nord-Ouest',
            self::NNW => 'Nord-Nord-Ouest',
        };
    }

    public static function getAllDirectionsAsArray(): array
    {
        $array = [];
        foreach (self::cases() as $enum) {
            $array[$enum->value] = $enum->label();
        }
        return $array;
    }
}
