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

        $hasReports = DB::table('weather_daily_reports')
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->exists();

        if(!$hasReports) {
            return view('pages.station-monthly-statistics', [
                "start" => $start,
                "station" => $station,
                "hasReports" => false,
            ]);
        }

        $stats = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as total_count_reports')
            ->selectRaw('min(max_temperature-min_temperature) as min_temperature_range')
            ->selectRaw('avg(max_temperature-min_temperature) as avg_temperature_range')
            ->selectRaw('max(max_temperature-min_temperature) as max_temperature_range')
            ->selectRaw('avg(min_temperature) as avg_min_temperature')
            ->selectRaw('max(min_temperature) as max_min_temperature')
            ->selectRaw('min(min_temperature) as min_min_temperature')
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
            ->selectRaw('sum(sunshine_duration) as sum_sunshine_duration')
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->first();


        $reportsWithMinTemperatureRange = $stats->min_temperature_range ? WeatherDailyReport::whereRaw('(max_temperature-min_temperature) = '. $stats->min_temperature_range)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->get() : null;


        $reportsWithMaxTemperatureRange = $stats->max_temperature_range ? WeatherDailyReport::whereRaw('(max_temperature-min_temperature) = '. $stats->max_temperature_range)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->get() : null;

        $reportsWithMinMinTemperature = $stats->min_min_temperature ? WeatherDailyReport::where('min_temperature', $stats->min_min_temperature)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->get() : null;

        $reportsWithMaxMinTemperature = $stats->max_min_temperature ? WeatherDailyReport::whereRaw('min_temperature = '. $stats->max_min_temperature)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->get() : null;

        $reportsWithMinMaxTemperature = $stats->min_max_temperature ? WeatherDailyReport::whereRaw('max_temperature = '. $stats->min_max_temperature)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->get() : null;

        $reportsWithMaxMaxTemperature = $stats->max_max_temperature ? WeatherDailyReport::whereRaw('max_temperature = '. $stats->max_max_temperature)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->get() : null;

        $countMinTemperatureSubMinus5 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_min_temperature_sub_minus_5')
            ->where('min_temperature','<=',-500)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->first();

        $countMinTemperatureSub0 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_min_temperature_sub_0')
            ->where('min_temperature','<=',0)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->first();

        $countMinTemperatureOver20 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_min_temperature_over_20')
            ->where('min_temperature','>=',2000)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->first();

        $countMaxTemperatureOver25 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_max_temperature_over_25')
            ->where('max_temperature','>=',2500)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->first();

        $countMaxTemperatureOver30 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_max_temperature_over_30')
            ->where('max_temperature','>=',3000)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->first();

        $countMaxTemperatureOver35 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_max_temperature_over_35')
            ->where('max_temperature','>=',3500)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->first();

        $countMaxTemperatureSub0 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_max_temperature_sub_0')
            ->where('max_temperature','<=',0)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->first();



        $countDaysWithPrecipitationOver1 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_precipitation_over_1')
            ->whereNotNull('precipitation')
            ->where("precipitation", '>=', 1)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->first();

        $countDaysWithPrecipitationOver5 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_precipitation_over_5')
            ->whereNotNull('precipitation')
            ->where("precipitation", '>=', 5)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->first();

        $countDaysWithPrecipitationOver10 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_precipitation_over_10')
            ->whereNotNull('precipitation')
            ->where("precipitation", '>=', 10)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->first();

        $countDaysWithPrecipitationOver40 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_precipitation_over_40')
            ->whereNotNull('precipitation')
            ->where("precipitation", '>=', 40)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->first();

        $reportsWithMaxPrecipitation = $stats->max_precipitation ? WeatherDailyReport::whereRaw('precipitation = '. $stats->max_precipitation)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->get() : null;

        $countDaysWithRain = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_rain')
            ->where("has_rain", 1)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->first();

        $countDaysWithSnow = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_snow')
            ->where("has_snow", 1)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->first();

        $countDaysWithHail = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_hail')
            ->where("has_hail", 1)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->first();

        $countDaysWithFog = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_fog')
            ->where("has_fog", 1)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->first();

        $countDaysWithGlaze = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_glaze')
            ->where("has_glaze", 1)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->first();

        $countDaysWithFlood = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_flood')
            ->where("has_flood", 1)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->first();

        $countDaysWithStorm = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_storm')
            ->where("has_storm", 1)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->first();

        $countDaysWithMaxWindSpeedOver36 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_max_wind_speed_over_36')
            ->where("max_wind_speed", '>=', 3600)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->first();

        $countDaysWithMaxWindSpeedOver58 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_max_wind_speed_over_58')
            ->where("max_wind_speed", '>=', 5800)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->first();

        $countDaysWithMaxWindSpeedOver76 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_max_wind_speed_over_76')
            ->where("max_wind_speed", '>=', 7600)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->first();

        $countDaysWithMaxWindSpeedOver100 = DB::table('weather_daily_reports')
            ->selectRaw('count(*) as count_days_with_max_wind_speed_over_100')
            ->where("max_wind_speed", '>=', 10000)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->first();

        $reportsWithMaxAvgWindSpeed = $stats->max_avg_wind_speed ? WeatherDailyReport::whereRaw('avg_wind_speed = '. $stats->max_avg_wind_speed)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->get() : null;

        $reportsWithMaxMaxWindSpeed = $stats->max_max_wind_speed ? WeatherDailyReport::whereRaw('max_wind_speed = '. $stats->max_max_wind_speed)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->get() : null;

        $reportsWithMaxMaxPressure = $stats->max_max_pressure ? WeatherDailyReport::whereRaw('max_pressure = '. $stats->max_max_pressure)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->get() : null;

        $reportsWithMinMinPressure = $stats->min_min_pressure ? WeatherDailyReport::whereRaw('min_pressure = '. $stats->min_min_pressure)
            ->where('weather_station_id', $station->id)
            ->whereDate("date", '>=', $start)
            ->whereDate("date", '<=', $end)
            ->get() : null;

        return view('pages.station-monthly-statistics', compact(
            'hasReports',
            'start',
            'station',
            'stats',
            'reportsWithMaxTemperatureRange',
            'reportsWithMinTemperatureRange',
            'reportsWithMinMinTemperature',
            'reportsWithMinMaxTemperature',
            'reportsWithMaxMinTemperature',
            'reportsWithMaxMaxTemperature',
            'countMinTemperatureSubMinus5',
            'countMinTemperatureSub0',
            'countMinTemperatureOver20',
            'countMaxTemperatureOver35',
            'countMaxTemperatureOver30',
            'countMaxTemperatureOver25',
            'countMaxTemperatureSub0',
            'countDaysWithPrecipitationOver1',
            'countDaysWithPrecipitationOver5',
            'countDaysWithPrecipitationOver10',
            'countDaysWithPrecipitationOver40',
            'reportsWithMaxPrecipitation',
            'countDaysWithRain',
            'countDaysWithFog',
            'countDaysWithFlood',
            'countDaysWithSnow',
            'countDaysWithGlaze',
            'countDaysWithHail',
            'countDaysWithStorm',
            'countDaysWithMaxWindSpeedOver36',
            'countDaysWithMaxWindSpeedOver58',
            'countDaysWithMaxWindSpeedOver76',
            'countDaysWithMaxWindSpeedOver100',
            'reportsWithMaxAvgWindSpeed',
            'reportsWithMaxMaxWindSpeed',
            'reportsWithMaxMaxPressure',
            'reportsWithMinMinPressure',
        ));
    }
}
