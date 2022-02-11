<?php

namespace App\Http\Controllers;

use App\Models\WeatherDailyReport;
use Carbon\Carbon;

class WeatherDailyReportsController extends Controller
{
    public function index()
    {
        $date = now()->lt(Carbon::createFromTimeString('18:00')) ? Carbon::yesterday() : Carbon::today();

        return view('pages.reports', [
            "date" => $date,
            "reports" => WeatherDailyReport::where("date", $date)->orderBy('created_at','asc')->get(),
        ]);
    }
}
