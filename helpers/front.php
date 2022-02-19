<?php

use Illuminate\Support\Carbon;

function format_report_value_from_storage($value, $precision = 2, $unit = null) : string
{
    if(!$value) {
        return "";
    }
    return round(number_format($value/100, 2, ".", ""), $precision) . ($unit ? " " . $unit : "");
}

function format_report_value_in_cm_from_storage($value) : string
{
    if(!$value) {
        return "";
    }
    return round(number_format($value/10, 2, ".", ""), 1) . " cm";
}

function get_bg_temperature(string $type, ?int $temperature, Carbon $date)
{
    if(!$temperature) {
        return 'grey-50';
    }

    $roundedTemperature = (int) round($temperature/100);

    $seasonal = ($type === 'max') ? [
        5,7,11,16,20,23,25,25,21,15,9,5
    ] : [
        -1,0,2,5,10,13,14,14,11,7,3,0
    ];

    $diff = $roundedTemperature - $seasonal[((int)$date->format('m')) - 1];

    return match($diff) {
        default => 'grey-50',
        -15,-16,-17,-18,-19,-20,-21,-22,-23,-24,-25 => 'blue-700',
        -13,-14 => 'blue-600',
        -11,-12 => 'blue-500',
        -9,-10 => 'blue-400',
        -7,-8 => 'blue-300',
        -5,-6 => 'blue-200',
        -3,-4 => 'blue-100',
        -1,-2 => 'blue-50',
        0 => 'grey-50',
        1,2 => 'orange-50',
        3,4 => 'orange-100',
        5,6 => 'orange-200',
        7,8 => 'orange-300',
        9,10 => 'orange-400',
        11,12 => 'orange-500',
        13,14 => 'orange-600',
        15,16,17,18,19,20,21,22,23,24,25 => 'orange-700',
    };
}
