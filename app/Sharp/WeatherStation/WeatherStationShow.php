<?php

namespace App\Sharp\WeatherStation;

use App\Models\Media;
use App\Models\WeatherStation;
use Code16\Sharp\Show\Fields\SharpShowEntityListField;
use Code16\Sharp\Show\Fields\SharpShowTextField;
use Code16\Sharp\Show\Layout\ShowLayout;
use Code16\Sharp\Show\Layout\ShowLayoutColumn;
use Code16\Sharp\Show\Layout\ShowLayoutSection;
use Code16\Sharp\Show\SharpShow;
use Code16\Sharp\Utils\Fields\FieldsContainer;

class WeatherStationShow extends SharpShow
{
    protected function buildShowFields(FieldsContainer $showFields): void
    {
        $showFields
            ->addField(
                SharpShowTextField::make('name')
                    ->setLabel('Nom')
            )
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
                SharpShowTextField::make("visuals")
            )
            ->addField(
                SharpShowEntityListField::make("daily_reports", "daily_reports")
                    ->setLabel("Relevés")
                    ->hideFilterWithValue("weather_station_id", function ($instanceId) {
                        return $instanceId;
                    })
            );
    }

    protected function buildShowLayout(ShowLayout $showLayout): void
    {
         $showLayout
             ->addSection('Informations', function(ShowLayoutSection $section) {
                 $section
                     ->addColumn(6, function(ShowLayoutColumn $column) {
                         $column
                             ->withSingleField('name')
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
             ->addEntityListSection("daily_reports");
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

    public function find($id): array
    {
        return $this
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
            ->transform(WeatherStation::findOrFail($id));
    }
}
