<?php

namespace App\Sharp\MyWeatherDailyReport;

use App\Models\Enums\WindDirection;
use App\Models\WeatherDailyReport;
use App\Sharp\Utils\FloatValueFromStorageFormAttributeTransformer;
use App\Sharp\Utils\FloatValueToStorageFormAttributeTransformer;
use Code16\Sharp\Form\Eloquent\Uploads\Transformers\SharpUploadModelFormAttributeTransformer;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormCheckField;
use Code16\Sharp\Form\Fields\SharpFormDateField;
use Code16\Sharp\Form\Fields\SharpFormListField;
use Code16\Sharp\Form\Fields\SharpFormSelectField;
use Code16\Sharp\Form\Fields\SharpFormTextareaField;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Fields\SharpFormUploadField;
use Code16\Sharp\Form\Layout\FormLayout;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\Layout\FormLayoutFieldset;
use Code16\Sharp\Form\SharpForm;
use Code16\Sharp\Utils\Fields\FieldsContainer;

class WeatherDailyReportForm extends SharpForm
{
    use WithSharpFormEloquentUpdater;

    protected ?string $formValidatorClass = WeatherDailyReportValidator::class;

    function buildFormFields(FieldsContainer $formFields) : void
    {
        $formFields
            ->addField(
                SharpFormListField::make("visuals")
                    ->setLabel("Photos")
                    ->setAddable()->setAddText("Ajouter une photo")
                    ->setRemovable()
                    ->setSortable()
                    ->setItemIdAttribute("id")
                    ->setOrderAttribute("order")
                    ->allowBulkUploadForField("file")
                    ->setBulkUploadFileCountLimitAtOnce(10)
                    ->setMaxItemCount(10)
                    ->addItemField(
                        SharpFormUploadField::make("file")
                            ->setMaxFileSize(4)
                            ->setFileFilterImages()
                            ->shouldOptimizeImage()
                            ->setStorageDisk("local")
                            ->setStorageBasePath("data/WeatherDailyReport/{id}")
                    )
            )
            ->addField(
                SharpFormDateField::make("date")
                    ->setLabel("Date du relevé")
                    ->setHasTime(false)
                    ->setDisplayFormat("DD/MM/YYYY")
            )
            ->addField(
                SharpFormTextField::make("min_temperature")
                    ->setLabel("Minimale")
                    ->setMaxLength(6)
            )
            ->addField(
                SharpFormTextField::make("max_temperature")
                    ->setLabel("Maximale")
                    ->setMaxLength(6)
            )
            ->addField(
                SharpFormTextField::make("pressure")
                    ->setLabel("Au moment du relevé")
                    ->setMaxLength(4)
            )
            ->addField(
                SharpFormTextField::make("min_pressure")
                    ->setLabel("Minimale")
                    ->setMaxLength(4)
            )
            ->addField(
                SharpFormTextField::make("max_pressure")
                    ->setLabel("Maximale")
                    ->setMaxLength(4)
            )
            ->addField(
                SharpFormTextField::make("precipitation")
                    ->setLabel("Précipitations en 24h")
                    ->setMaxLength(4)
                    ->setHelpMessage('en mm')
            )
            ->addField(
                SharpFormTextField::make("sunshine_duration")
                    ->setLabel("Insolation")
                    ->setMaxLength(2)
                    ->setHelpMessage('en nombre d\'heures')
            )
            ->addField(
                SharpFormTextField::make("snow_depth")
                    ->setLabel("Epaisseur de neige")
                    ->setMaxLength(2)
                    ->setHelpMessage('en mm')
            )
            ->addField(
                SharpFormSelectField::make("wind_direction",
                    WindDirection::getAllDirectionsAsArray()
                )
                    ->setLabel("Direction dominante")
                    ->setDisplayAsDropdown()
                    ->setClearable()
            )
            ->addField(
                SharpFormTextField::make("avg_wind_speed")
                    ->setLabel("Vitesse moyenne")
                    ->setMaxLength(6)
                    ->setHelpMessage('en km/h')
            )
            ->addField(
                SharpFormTextField::make("max_wind_speed")
                    ->setLabel("Vitesse maximale")
                    ->setMaxLength(6)
                    ->setHelpMessage('en km/h')
            )
            ->addField(
                SharpFormCheckField::make("has_rain",'Pluie')
            )
            ->addField(
                SharpFormCheckField::make("has_storm",'Orage')
            )
            ->addField(
                SharpFormCheckField::make("has_hail",'Grêle')
            )
            ->addField(
                SharpFormCheckField::make("has_snow",'Neige')
            )
            ->addField(
                SharpFormCheckField::make("has_fog",'Brouillard')
            )
            ->addField(
                SharpFormCheckField::make("has_flood",'Innondation')
            )
            ->addField(
                SharpFormTextareaField::make("comment")
                    ->setLabel("Commentaire")
                    ->setRowCount(4)
            )
        ;
    }

    function buildFormLayout(FormLayout $formLayout): void
    {
        $formLayout
            ->addColumn(6, function(FormLayoutColumn $column) {
                $column
                    ->withFields("date")
                    ->withFieldset("Température (en °c)", function(FormLayoutFieldset $fieldset) {
                        return $fieldset
                            ->withFields("min_temperature|4", "max_temperature|4");
                    })
                    ->withFieldset("Pression (en hPa)", function(FormLayoutFieldset $fieldset) {
                        return $fieldset
                            ->withFields("min_pressure|4", "max_pressure|4", "pressure|4");
                    })
                    ->withFieldset("Elements", function(FormLayoutFieldset $fieldset) {
                        return $fieldset
                            ->withFields("precipitation|4", "snow_depth|4", "sunshine_duration|4");
                    })
                    ->withFieldset("Vent", function(FormLayoutFieldset $fieldset) {
                        return $fieldset
                            ->withFields("wind_direction|4", "avg_wind_speed|4", "max_wind_speed|4");
                    })
                    ;
            })
            ->addColumn(6, function(FormLayoutColumn $column) {
                $column
                    ->withFieldset("Phénomènes observés", function(FormLayoutFieldset $fieldset) {
                        return $fieldset
                            ->withFields("has_rain")
                            ->withFields("has_storm")
                            ->withFields("has_hail")
                            ->withFields("has_snow")
                            ->withFields("has_fog")
                            ->withFields("has_flood");
                    })
                    ->withSingleField("comment")
                    ->withSingleField("visuals", function (FormLayoutColumn $item) {
                        return $item
                            ->withSingleField("file");
                    });
            });
    }

    public function buildFormConfig(): void
    {
        $this->configurePageAlert(
            "Vous allez saisir un relevé méteo journalier.",
            static::$pageAlertLevelInfo
        );
    }

    function find($id): array
    {
        return $this
            ->setCustomTransformer("visuals", new SharpUploadModelFormAttributeTransformer())
            ->setCustomTransformer("min_temperature", new FloatValueFromStorageFormAttributeTransformer())
            ->transform(WeatherDailyReport::with('visuals')->findOrFail($id));
    }

    function update($id, array $data)
    {
        $report = $id
            ? WeatherDailyReport::findOrFail($id)
            : new WeatherDailyReport([
                "weather_station_id" => auth()->id(), //@todo
            ]);

        $this
            ->setCustomTransformer("min_temperature", new FloatValueToStorageFormAttributeTransformer())
            ->save($report, $data);

        return $report->id;
    }

    public function delete($id): void
    {
        WeatherDailyReport::findOrFail($id)->delete();
    }
}
