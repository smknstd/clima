<?php

namespace App\Http\Controllers;

use App\Models\WeatherDailyReport;
use Carbon\Carbon;

class WeatherDailyReportsController extends Controller
{
    public function index()
    {
        return view('pages.reports', [
            "reports" => WeatherDailyReport::where("date", Carbon::yesterday())->orderBy('created_at','asc')->get(),
        ]);
    }
}
