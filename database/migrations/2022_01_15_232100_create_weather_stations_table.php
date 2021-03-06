<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_stations', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->string('creation_date')->nullable();
            $table->string('city');
            $table->string('postal_code');
            $table->unsignedInteger('altitude')->nullable();
            $table->string('hardware_details')->nullable();
            $table->string('website_url')->nullable();
            $table->softDeletes();
            $table->foreignId("user_id")->constrained()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather_stations');
    }
}
