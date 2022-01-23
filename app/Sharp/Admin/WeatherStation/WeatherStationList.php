<?php

namespace App\Sharp\Admin\WeatherStation;

use App\Models\WeatherDailyReport;
use App\Models\WeatherStation;
use Carbon\Carbon;
use Code16\Sharp\EntityList\Fields\EntityListField;
use Code16\Sharp\EntityList\Fields\EntityListFieldsContainer;
use Code16\Sharp\EntityList\Fields\EntityListFieldsLayout;
use Code16\Sharp\EntityList\SharpEntityList;
use Illuminate\Contracts\Support\Arrayable;

class WeatherStationList extends SharpEntityList
{
    public function buildListFields(EntityListFieldsContainer $fieldsContainer): void
    {
        $fieldsContainer
            ->addField(
                EntityListField::make("user")
                    ->setLabel("Utilisateur")
            )
            ->addField(
                EntityListField::make("city")
                    ->setLabel("Lieu")
            )
            ->addField(
                EntityListField::make("reports")
                    ->setLabel("Relevés")
            )
            ->addField(
                EntityListField::make("hardware_details")
                    ->setLabel("Materiel")
            )
            ->addField(
                EntityListField::make("created_at")
                    ->setLabel("Ajout au site")
            );
    }

    public function buildListLayout(EntityListFieldsLayout $fieldsLayout): void
    {
        $fieldsLayout
            ->addColumn("user", 2)
            ->addColumn("city", 2)
            ->addColumn("reports", 3)
            ->addColumn("hardware_details", 3)
            ->addColumn("created_at", 2);
    }

    public function buildListConfig(): void
    {

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
            ->setCustomTransformer("created_at", function ($value, WeatherStation $weatherStation) {
                return $weatherStation->created_at->format('d/m/Y');
            })
            ->setCustomTransformer("reports", function ($value, WeatherStation $weatherStation) {
                if ($result = WeatherDailyReport::selectRaw('max(date) as last_created_at, count(*) as total')->where('weather_station_id', $weatherStation->id)->first()) {
                    return sprintf(
                        '%s<div style="color: gray"><small>Date du dernier: %s</small></div>',
                        $result->total,
                        Carbon::parse($result->last_created_at)->format('d/m/Y')
                    );
                }
                return '0';
            })
            ->setCustomTransformer("user", function ($value, WeatherStation $weatherStation) {
                return $weatherStation->user->name;
            })
            ->setCustomTransformer("city", function ($value, WeatherStation $weatherStation) {
                return $weatherStation->city . ", " . $weatherStation->postal_code;
            })
            ->transform(
                WeatherStation::orderBy('created_at', 'desc')->get()
            );
    }
}
