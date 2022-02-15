<?php

namespace App\Http\Controllers;

use App\Models\WeatherDailyReport;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;

class WeatherDailyReportsController extends Controller
{
    public function index(Request $request, int $year = null, int $month = null, int $day = null)
    {
        if ($year && $month && $day) {
            $this->validate($request, ['year' => 'integer|min:2008|max:2025']);
            $date = CarbonImmutable::createFromDate($year, $month, $day);
        } else {
            $date = now()->lt(Carbon::createFromTimeString('18:00')) ? CarbonImmutable::yesterday() : CarbonImmutable::today();
        }

        return view('pages.reports', [
            "date" => $date,
            "reports" => WeatherDailyReport::whereDate("date", $date)->orderBy('created_at','asc')->get(),
        ]);
    }
}
