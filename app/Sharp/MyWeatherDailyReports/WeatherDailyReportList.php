<?php

namespace App\Sharp\MyWeatherDailyReports;

use App\Models\Media;
use App\Models\WeatherDailyReport;
use App\Models\WeatherStation;
use App\Sharp\MyWeatherDailyReports\Filters\ReportDateFilterHandler;
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

    function getFilters(): ?array
    {
        return [
            ReportDateFilterHandler::class,
        ];
    }


    public function buildListConfig(): void
    {
        $this
            ->configureSearchable()
            ->configurePaginated();
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
        $reports = WeatherDailyReport::where('weather_station_id', auth()->user()->weatherStation->id)
            ->orderBy('date', 'desc');

        if ($this->queryParams->hasSearch()) {
            foreach ($this->queryParams->searchWords() as $word) {
                $reports->where(function ($query) use ($word) {
                    $query
//                        ->where('last_name', 'like', $word)
                        ->orWhere('comment', 'like', $word);
                });
            }
        }

        if ($date = $this->queryParams->filterFor("report_date")) {
            $reports->whereBetween('date', [
                $date['start'],
                $date['end'],
            ]);
        }

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
                $reports->paginate(40)
            );
    }
}
