<?php

namespace App\Http\Controllers;

use App\Models\WeatherDailyReport;
use App\Models\WeatherStation;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;

class StationMonthlyStatisticsController extends Controller
{
    public function show(WeatherStation $station, int $year, int $month)
    {
        $start = CarbonImmutable::createFromDate($year,$month,1)->startOfDay();
        $end = $start->endOfMonth();

        $exists = DB::table('weather_daily_reports')
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->exists();

        if(!$exists) {
            return view('pages.station-monthly-statistics', [
                "start_date" => $start,
                "station" => $station,
                "empty" => true,
            ]);
        }

        $stats = DB::table('weather_daily_reports')
            ->selectRaw('min(max_temperature-min_temperature) as min_temperature_range')
            ->selectRaw('avg(max_temperature-min_temperature) as avg_temperature_range')
            ->selectRaw('max(max_temperature-min_temperature) as max_temperature_range')
            ->selectRaw('avg(min_temperature) as avg_min_temperature')
            ->selectRaw('max(max_temperature) as max_min_temperature')
            ->selectRaw('min(max_temperature) as min_min_temperature')
            ->selectRaw('avg(max_temperature) as avg_max_temperature')
            ->selectRaw('max(max_temperature) as max_max_temperature')
            ->selectRaw('min(max_temperature) as min_max_temperature')
            ->selectRaw('sum(precipitation) as sum_precipitation')
            ->selectRaw('max(precipitation) as max_precipitation')
            ->selectRaw('avg(avg_wind_speed) as avg_avg_wind_speed')
            ->selectRaw('max(avg_wind_speed) as max_avg_wind_speed')
            ->selectRaw('max(max_wind_speed) as max_max_wind_speed')
            ->selectRaw('max(max_pressure) as max_max_pressure')
            ->selectRaw('min(min_pressure) as min_min_pressure')
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->first();

        $reportsWithMinTemperatureRange = WeatherDailyReport::whereRaw('(max_temperature-min_temperature) = '. $stats->min_temperature_range)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->get();

        $reportsWithMaxTemperatureRange = WeatherDailyReport::whereRaw('(max_temperature-min_temperature) = '. $stats->max_temperature_range)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->get();

        $reportsWithMinMinTemperature = WeatherDailyReport::whereRaw('min_temperature = '. $stats->min_min_temperature)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->get();

        $reportsWithMaxMinTemperature = WeatherDailyReport::whereRaw('min_temperature = '. $stats->max_min_temperature)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->get();

        $reportsWithMinMaxTemperature = WeatherDailyReport::whereRaw('max_temperature = '. $stats->min_max_temperature)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->get();

        $reportsWithMaxMaxTemperature = WeatherDailyReport::whereRaw('max_temperature = '. $stats->max_max_temperature)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->get();

        $countMinTemperatureSubMinus5 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_min_temperature_sub_minus_5')
            ->where('min_temperature','<=',-500)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->first();

        $countMinTemperatureSub0 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_min_temperature_sub_0')
            ->where('min_temperature','<=',0)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->first();

        $countMinTemperatureOver20 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_min_temperature_over_20')
            ->where('min_temperature','>=',2000)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->first();

        $countMaxTemperatureOver25 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_max_temperature_over_25')
            ->where('min_temperature','>=',2500)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->first();

        $countMaxTemperatureOver30 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_max_temperature_over_30')
            ->where('min_temperature','>=',3000)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->first();

        $countMaxTemperatureOver35 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_max_temperature_over_35')
            ->where('min_temperature','>=',3500)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->first();

        $countMaxTemperatureSub0 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_max_temperature_sub_0')
            ->where('min_temperature','<=',0)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->first();

        $countDaysWithPrecipitation = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_precipitation')
            ->whereNotNull('precipitation')
            ->where("precipitation", '>=', 0)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->first();

        $countDaysWithPrecipitationOver1 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_precipitation_over_1')
            ->whereNotNull('precipitation')
            ->where("precipitation", '>=', 1)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->first();

        $countDaysWithPrecipitationOver5 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_precipitation_over_5')
            ->whereNotNull('precipitation')
            ->where("precipitation", '>=', 5)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->first();

        $countDaysWithPrecipitationOver10 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_precipitation_over_10')
            ->whereNotNull('precipitation')
            ->where("precipitation", '>=', 10)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->first();

        $countDaysWithPrecipitationOver40 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_precipitation_over_40')
            ->whereNotNull('precipitation')
            ->where("precipitation", '>=', 40)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->first();

        $reportsWithMaxPrecipitation = WeatherDailyReport::whereRaw('precipitation = '. $stats->max_precipitation)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->get();

        $countDaysWithSnow = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_snow')
            ->whereNotNull('precipitation')
            ->where("has_snow", 1)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->first();

        $countDaysWithHail = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_snow')
            ->whereNotNull('precipitation')
            ->where("has_hail", 1)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->first();

        $countDaysWithFog = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_fog')
            ->whereNotNull('precipitation')
            ->where("has_fog", 1)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->first();

        $countDaysWithFlood = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_flood')
            ->whereNotNull('precipitation')
            ->where("has_flood", 1)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->first();

        $countDaysWithStorm = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_storm')
            ->whereNotNull('precipitation')
            ->where("has_storm", 1)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->first();

        $countDaysWithMaxWindSpeedOver36 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_max_wind_speed_over_36')
            ->where("max_wind_speed", '>=', 3600)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->first();

        $countDaysWithMaxWindSpeedOver58 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_max_wind_speed_over_58')
            ->where("max_wind_speed", '>=', 5800)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->first();

        $countDaysWithMaxWindSpeedOver76 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_max_wind_speed_over_76')
            ->where("max_wind_speed", '>=', 7600)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->first();

        $countDaysWithMaxWindSpeedOver100 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_max_wind_speed_over_100')
            ->where("max_wind_speed", '>=', 10000)
            ->where('weather_station_id', $station->id)
            ->where("date", '>=', $start)
            ->where("date", '<=', $end)
            ->first();

        return view('pages.station-monthly-reports', [
            "start_date" => $start,
            "station" => $station,
            "reports" => $reports,
        ]);
    }
}
