<?php

namespace App\Sharp\WeatherStation;

use Code16\Sharp\Utils\Entities\SharpEntity;

class WeatherStationEntity extends SharpEntity
{
    protected ?string $list = WeatherStationList::class;
    protected ?string $show = WeatherStationShow::class;
    protected ?string $form = WeatherStationForm::class;
    protected ?string $policy = WeatherStationPolicy::class;
    protected string $label = "Mes stations";

}
