<?php

function format_report_value_from_storage($value, $precision = 2, $unit = null) : string
{
    if(!$value) {
        return "";
    }
    return round(number_format($value/100, 2, ".", ""), $precision) . ($unit ? " " . $unit : "");
}
