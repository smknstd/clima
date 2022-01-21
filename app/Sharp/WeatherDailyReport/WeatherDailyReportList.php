<?php

namespace App\Sharp\WeatherDailyReport;

use App\Models\Media;
use App\Models\WeatherDailyReport;
use App\Models\WeatherStation;
use Code16\Sharp\EntityList\Fields\EntityListField;
use Code16\Sharp\EntityList\Fields\EntityListFieldsContainer;
use Code16\Sharp\EntityList\Fields\EntityListFieldsLayout;
use Code16\Sharp\EntityList\SharpEntityList;
use Illuminate\Contracts\Support\Arrayable;

class WeatherDailyReportList extends SharpEntityList
{
    public function buildListFields(EntityListFieldsContainer $fieldsContainer): void
    {
        $fieldsContainer
            ->addField(
                EntityListField::make("date")
                    ->setSortable()
                    ->setLabel("Date")
            )
            ->addField(
                EntityListField::make("visual")
                    ->setLabel("Photo")
            )
            ->addField(
                EntityListField::make("comment")
                    ->setLabel("Commentaire")
            );
    }

    public function buildListLayout(EntityListFieldsLayout $fieldsLayout): void
    {
        $fieldsLayout
            ->addColumn("date", 2)
            ->addColumn("visual", 2)
            ->addColumn("comment", 8);
    }

    public function buildListConfig(): void
    {
        $this->configurePaginated();
    }

    function getInstanceCommands(): ?array
    {
        return [];
    }

    function getEntityCommands(): ?array
    {
        return [];
    }

    public function getListData(): array|Arrayable
    {

        return $this
            ->setCustomTransformer("date",function ($value, WeatherDailyReport $weatherDailyReport) {
                return sprintf(
                    '%s<div style="color: grey"><small>%s</small></div>',
                    $weatherDailyReport->date->isoFormat('Do/MM/YYYY'),
                    $weatherDailyReport->date->isoFormat('dddd'),
                );
            })
            ->setCustomTransformer("visual",function ($value, WeatherDailyReport $weatherDailyReport) {
                if($visual = $weatherDailyReport->visuals->first()) {
                    return '<img src="' . $visual->thumbnail(140) . '" alt="" class="img-fluid">';

                }
            })
            ->transform(
                WeatherDailyReport::where('weather_station_id', $this->queryParams->filterFor("weather_station_id"))
                    ->orderBy('date', 'desc')
                    ->paginate(40)
            );
    }
}
