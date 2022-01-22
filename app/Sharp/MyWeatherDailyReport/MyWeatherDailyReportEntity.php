<?php

namespace App\Sharp\MyWeatherDailyReport;

use Code16\Sharp\Utils\Entities\SharpEntity;

class MyWeatherDailyReportEntity extends SharpEntity
{
    protected ?string $list = WeatherDailyReportList::class;
    protected ?string $form = WeatherDailyReportForm::class;
    protected ?string $policy = WeatherDailyReportPolicy::class;
    protected string $label = "Mes relevés journaliers";

}
