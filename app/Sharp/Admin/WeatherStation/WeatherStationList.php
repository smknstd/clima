<?php

namespace App\Sharp\Admin\WeatherStation;

use App\Models\WeatherDailyReport;
use App\Models\WeatherStation;
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
                EntityListField::make("total_report_count")
                    ->setLabel("Relevés")
            )
            ->addField(
                EntityListField::make("hardware_details")
                    ->setLabel("Materiel")
            )
            ->addField(
                EntityListField::make("created_at")
                    ->setLabel("Date d'ajout au site")
            );
    }

    public function buildListLayout(EntityListFieldsLayout $fieldsLayout): void
    {
        $fieldsLayout
            ->addColumn("user", 3)
            ->addColumn("city", 3)
            ->addColumn("total_report_count", 1)
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
            ->setCustomTransformer("user", function ($value, WeatherStation $weatherStation) {
                return $weatherStation->user->name;
            })
            ->setCustomTransformer("city", function ($value, WeatherStation $weatherStation) {
                return $weatherStation->city . ", " . $weatherStation->postal_code;
            })
            ->setCustomTransformer("total_report_count", function ($value, WeatherStation $weatherStation) {
                return WeatherDailyReport::where('weather_station_id', $weatherStation->id)->count();
            })
            ->transform(
                WeatherStation::orderBy('created_at', 'desc')->get()
            );
    }
}
