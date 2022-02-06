<?php

namespace App\Http\Controllers;

use App\Models\WeatherStation;

class AboutController extends Controller
{
    public function index()
    {
        return view('pages.about', []);
    }
}
