<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\StationMonthlyStatisticsController;
use App\Http\Controllers\StationMonthlyWeatherReportsController;
use App\Http\Controllers\StationsController;
use App\Http\Controllers\WeatherDailyReportsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/blog', [BlogController::class, 'index'])
    ->name('blog');

Route::get('/blog/{blogpost}', [BlogController::class, 'show'])
    ->name('blogpost');

Route::get('/a-propos', [AboutController::class, 'index'])
    ->name('about');

Route::get('/stations', [StationsController::class, 'index'])
    ->name('stations');

Route::get('/station/{station}', [StationController::class, 'show'])
    ->name('station');

Route::get('/station/{station}/releves/{year}/{month}', [StationMonthlyWeatherReportsController::class, 'show'])
    ->name('station-monthly-reports')
    ->where([
        'year' => '[0-9]{4}',
        'month' => '[0-9]{2}',
    ]);

Route::get('/station/{station}/statistics/{year}/{month}', [StationMonthlyStatisticsController::class, 'show'])
    ->name('station-monthly-statistics')
    ->where([
        'year' => '[0-9]{4}',
        'month' => '[0-9]{2}',
    ]);

Route::get('/releves', [WeatherDailyReportsController::class, 'index'])
    ->name('reports');

Route::get('/releves/{year}/{month}/{day}', [WeatherDailyReportsController::class, 'index'])
    ->name('reports-day')
    ->where([
        'year' => '[0-9]{4}',
        'month' => '[0-9]{2}',
        'day' => '[0-9]{2}',
    ]);
