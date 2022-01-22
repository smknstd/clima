<?php

namespace App\Sharp\MyWeatherStation;

use App\Models\Media;
use App\Models\User;
use App\Models\WeatherDailyReport;
use App\Models\WeatherStation;
use Carbon\Carbon;
use Code16\Sharp\Show\Fields\SharpShowEntityListField;
use Code16\Sharp\Show\Fields\SharpShowTextField;
use Code16\Sharp\Show\Layout\ShowLayout;
use Code16\Sharp\Show\Layout\ShowLayoutColumn;
use Code16\Sharp\Show\Layout\ShowLayoutSection;
use Code16\Sharp\Show\SharpShow;
use Code16\Sharp\Show\SharpSingleShow;
use Code16\Sharp\Utils\Fields\FieldsContainer;
use Code16\Sharp\Utils\Transformers\Attributes\Eloquent\SharpUploadModelThumbnailUrlTransformer;

class WeatherStationSingleShow extends SharpSingleShow
{
    protected function buildShowFields(FieldsContainer $showFields): void
    {
        $showFields
            ->addField(
                SharpShowTextField::make('description')
                    ->setLabel('Description')
            )
            ->addField(
                SharpShowTextField::make('website_url')
                    ->setLabel('Lien vers un site web externe')
            )
            ->addField(
                SharpShowTextField::make('creation_date')
                    ->setLabel('Date de mise en service')
            )
            ->addField(
                SharpShowTextField::make('city')
                    ->setLabel('Ville')
            )
            ->addField(
                SharpShowTextField::make('postal_code')
                    ->setLabel('Code postal')
            )
            ->addField(
                SharpShowTextField::make('altitude')
                    ->setLabel('Altitude')
            )
            ->addField(
                SharpShowTextField::make('hardware_details')
                    ->setLabel('Détails du matériel utilisé')
            )
            ->addField(
                SharpShowTextField::make('total_report_count')
                    ->setLabel('Nombre total de relevés')
            )
            ->addField(
                SharpShowTextField::make('oldest_report_date')
                    ->setLabel('Date du plus ancien relevé')
            )
            ->addField(
                SharpShowTextField::make('last_report_date')
                    ->setLabel('Date du relevé le plus récent')
            )
            ->addField(
                SharpShowTextField::make("visuals")
            );
    }

    protected function buildShowLayout(ShowLayout $showLayout): void
    {
         $showLayout
             ->addSection('Informations', function(ShowLayoutSection $section) {
                 $section
                     ->addColumn(6, function(ShowLayoutColumn $column) {
                         $column
                             ->withSingleField('description')
                             ->withSingleField('creation_date');
                     })
                     ->addColumn(6, function(ShowLayoutColumn $column) {
                         $column
                             ->withSingleField('city')
                             ->withSingleField('altitude');
                     });
             })
             ->addSection('Matériel', function(ShowLayoutSection $section) {
                 $section
                     ->addColumn(6, function(ShowLayoutColumn $column) {
                         $column
                             ->withSingleField('hardware_details')
                             ->withSingleField('website_url');
                     })
                     ->addColumn(6, function(ShowLayoutColumn $column) {
                         $column
                             ->withSingleField('visuals');
                     });
             })
             ->addSection('Relevés journaliers', function(ShowLayoutSection $section) {
                 $section
                     ->addColumn(6, function(ShowLayoutColumn $column) {
                         $column
                             ->withSingleField('total_report_count')
                             ->withSingleField('oldest_report_date')
                             ->withSingleField('last_report_date');
                     });
             });
    }

    public function buildShowConfig(): void
    {
        $this
            ->configureBreadcrumbCustomLabelAttribute("name");
    }

    public function getInstanceCommands(): ?array
    {
        return [];
    }

    public function findSingle(): array
    {
        return $this
            ->setCustomTransformer("total_report_count", function ($value, WeatherStation $weatherStation) {
                return WeatherDailyReport::where('weather_station_id', $weatherStation->id)->count();
            })
            ->setCustomTransformer("oldest_report_date", function ($value, WeatherStation $weatherStation) {
                if ($result = WeatherDailyReport::selectRaw('min(date) as oldest_created_at')->where('weather_station_id', $weatherStation->id)->first()) {
                    return Carbon::parse($result->oldest_created_at)->isoFormat('LL');
                }
                return 'aucun relevé enregistré';
            })
            ->setCustomTransformer("last_report_date", function ($value, WeatherStation $weatherStation) {
                if ($result = WeatherDailyReport::selectRaw('max(date) as last_created_at')->where('weather_station_id', $weatherStation->id)->first()) {
                    return Carbon::parse($result->last_created_at)->isoFormat('LL');
                }
                return 'aucun relevé enregistré';
            })
            ->setCustomTransformer("city", function ($value, WeatherStation $weatherStation) {
                return $weatherStation->postal_code . " " . $weatherStation->city;
            })
            ->setCustomTransformer("description", function ($value, WeatherStation $weatherStation) {
                return $value ?? '<i>Non renseigné</i>';
            })
            ->setCustomTransformer("visuals",function ($value, WeatherStation $weatherStation) {
                return $weatherStation->visuals->reduce(function($acc, Media $visual) {
                    return $acc . '<img src="' . $visual->thumbnail(140) . '" alt="" class="img-fluid">';
                }, '');
            })
            ->setCustomTransformer("website_url", function ($value, WeatherStation $weatherStation) {
                return sprintf("<a href='%s'>%s</a>", $value, $value);
            })
            ->transform(auth()->user()->weatherStation);
    }
}
