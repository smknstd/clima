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
                SharpFormTextareaField::make("comment")
                    ->setLabel("Commentaire")
                    ->setRowCount(4)
            );
    }

    function buildFormLayout(FormLayout $formLayout): void
    {
        $formLayout
            ->addColumn(6, function(FormLayoutColumn $column) {
                $column
                    ->withFields("date")
                    ->withFields("comment");
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
            ->transform(WeatherDailyReport::with('visuals')->findOrFail($id));
    }

    function update($id, array $data)
    {
        $report = WeatherDailyReport::findOrFail($id);

        $this->save($report, $data);

        return $report->id;
    }

    public function delete($id): void
    {
        WeatherDailyReport::findOrFail($id)->delete();
    }
}
