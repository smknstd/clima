<?php

function format_report_value_from_storage($value, $precision = 2, $unit = null) : string
{
    if(!$value) {
        return "";
    }
    return round(number_format($value/100, 2, ".", ""), $precision) . ($unit ? " " . $unit : "");
}

function get_bg_temperature($temperature)
{
    $roundedTemperature = (int)(ceil( round($temperature/100) / 5 ) * 5);

    return match($roundedTemperature) {
        -40, -35, -30, -25, -20, -15 => "bg-blue-800",
        -10 => "bg-blue-600",
        -5 => "bg-blue-400",
        0 => "bg-blue-200",
        5 => "bg-red-200",
        10 => "bg-red-400",
        15 => "bg-red-600",
        20 => "bg-red-700",
        25 => "bg-red-800",
        30, 35, 40, 45, 50, 55 => "bg-red-900",
    };
}
