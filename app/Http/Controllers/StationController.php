<?php

namespace App\Http\Controllers;

use App\Models\WeatherStation;

class StationController extends Controller
{
    public function show(WeatherStation $station)
    {
        return view('pages.station', [
            "station" => $station,
        ]);
    }
}
