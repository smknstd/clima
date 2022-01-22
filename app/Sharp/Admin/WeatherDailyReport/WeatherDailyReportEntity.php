<?php

namespace App\Sharp\Admin\WeatherDailyReport;

use Code16\Sharp\Utils\Entities\SharpEntity;

class WeatherDailyReportEntity extends SharpEntity
{
    protected ?string $list = WeatherDailyReportList::class;
    protected ?string $form = WeatherDailyReportForm::class;
    protected ?string $policy = WeatherDailyReportPolicy::class;
    protected string $label = "Relevés journaliers";

}
