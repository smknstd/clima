<?php

namespace App\Http\Controllers;

use App\Models\WeatherStation;

class StationsController extends Controller
{
    public function index()
    {
        return view('pages.stations', [
            "stations" => WeatherStation::orderBy('created_at','asc')->get(),
        ]);
    }
}
