<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherDailyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_daily_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId("weather_station_id")->constrained();

            $table->date('date');

            $table->smallInteger('min_temperature')->nullable();
            $table->smallInteger('max_temperature')->nullable();
            $table->smallInteger('pressure')->nullable();
            $table->smallInteger('min_pressure')->nullable();
            $table->smallInteger('max_pressure')->nullable();
            $table->smallInteger('precipitation')->nullable();
            $table->smallInteger('sunshine_duration')->nullable();
            $table->smallInteger('snow_depth')->nullable();
            $table->string('wind_direction')->nullable();
            $table->smallInteger('avg_wind_speed')->nullable();
            $table->smallInteger('max_wind_speed')->nullable();

            $table->boolean('has_rain')->default(false);
            $table->boolean('has_storm')->default(false);
            $table->boolean('has_hail')->default(false);
            $table->boolean('has_snow')->default(false);
            $table->boolean('has_fog')->default(false);
            $table->boolean('has_flood')->default(false);

            $table->string('comment')->nullable();

            $table->timestamps();

            $table->unique([
                'weather_station_id', 'date'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather_daily_reports');
    }
}
