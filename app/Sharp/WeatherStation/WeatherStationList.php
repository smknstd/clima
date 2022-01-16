<?php

namespace App\Sharp\WeatherStation;

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
                EntityListField::make("name")
                    ->setSortable()
                    ->setLabel("Nom")
            )
            ->addField(
                EntityListField::make("city")
                    ->setLabel("Lieu")
            )
            ->addField(
                EntityListField::make("hardware_details")
                    ->setLabel("Materiel")
            );
    }

    public function buildListLayout(EntityListFieldsLayout $fieldsLayout): void
    {
        $fieldsLayout
            ->addColumn("name", 4)
            ->addColumn("city", 3)
            ->addColumn("hardware_details", 4);
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
            ->setCustomTransformer("city", function ($value, WeatherStation $weatherStation) {
                return $weatherStation->city . ", " . $weatherStation->postal_code;
            })
            ->transform(
                WeatherStation::where('user_id', auth()->id())
                    ->orderBy('created_at', 'desc')
                    ->get()
            );
    }
}
