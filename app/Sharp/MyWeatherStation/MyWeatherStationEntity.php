<?php

namespace App\Sharp\MyWeatherStation;

use Code16\Sharp\Utils\Entities\SharpEntity;

class MyWeatherStationEntity extends SharpEntity
{
    protected bool $isSingle = true;
    protected ?string $show = WeatherStationSingleShow::class;
    protected ?string $form = WeatherStationSingleForm::class;
    protected ?string $policy = WeatherStationPolicy::class;
    protected string $label = "Ma station";

}
