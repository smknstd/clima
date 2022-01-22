<?php

namespace App\Sharp\Admin\WeatherDailyReport;

use App\Models\WeatherDailyReport;
use App\Models\WeatherStation;
use App\Sharp\Utils\FloatValueFromStorageFormAttributeTransformer;
use App\Sharp\Utils\FloatValueToStorageFormAttributeTransformer;
use Code16\Sharp\Form\Eloquent\Uploads\Transformers\SharpUploadModelFormAttributeTransformer;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormDateField;
use Code16\Sharp\Form\Fields\SharpFormListField;
use Code16\Sharp\Form\Fields\SharpFormTextareaField;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Fields\SharpFormUploadField;
use Code16\Sharp\Form\Layout\FormLayout;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
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
                    ->setLabel("Date")
                    ->setHasTime(false)
                    ->setDisplayFormat("DD/MM/YYYY")
            )
            ->addField(
                SharpFormTextField::make("min_temperature")
                    ->setLabel("Température minimum")
                    ->setMaxLength(6)
            );
    }

    function buildFormLayout(FormLayout $formLayout): void
    {
        $formLayout
            ->addColumn(6, function(FormLayoutColumn $column) {
                $column
                    ->withFields("date")
                    ->withFields("min_temperature");
            })
            ->addColumn(6, function(FormLayoutColumn $column) {
                $column
                    ->withSingleField("visuals", function (FormLayoutColumn $item) {
                        return $item
                            ->withSingleField("file");
                    });
            });
    }

    public function buildFormConfig(): void
    {
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
