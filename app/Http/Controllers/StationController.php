<?php

namespace App\Http\Controllers;

use App\Models\WeatherDailyReport;
use App\Models\WeatherStation;

class StationController extends Controller
{
    public function show(WeatherStation $station)
    {
        return view('pages.station', [
            "station" => $station,
            "report_count" => WeatherDailyReport::where('weather_station_id', $station->id)->count(),
        ]);
    }
}
