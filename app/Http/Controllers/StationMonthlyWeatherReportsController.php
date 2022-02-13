<?php

namespace App\Http\Controllers;

use App\Models\WeatherDailyReport;
use App\Models\WeatherStation;
use Carbon\CarbonImmutable;

class StationMonthlyWeatherReportsController extends Controller
{
    public function show(WeatherStation $station, int $year, int $month)
    {
        $start = CarbonImmutable::createFromDate($year,$month,1)->startOfDay();
        $end = $start->endOfMonth();

        $reports = WeatherDailyReport::where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->orderBy('date','asc')
            ->get();

        return view('pages.station-monthly-reports', [
            "start" => $start,
            "station" => $station,
            "reports" => $reports,
        ]);
    }
}
