<?php

namespace App\Sharp\WeatherDailyReport;

use App\Models\WeatherStation;
use Code16\Sharp\Form\Eloquent\Uploads\Transformers\SharpUploadModelFormAttributeTransformer;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
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
                    ->setLabel("Photos de l'installation")
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
                            ->setStorageBasePath("data/WeatherStation/{id}")
                    )
            )
            ->addField(
                SharpFormTextField::make("name")
                    ->setLabel("Nom")
                    ->setMaxLength(300)
            )
            ->addField(
                SharpFormTextField::make("city")
                    ->setLabel("Ville")
                    ->setMaxLength(300)
            )
            ->addField(
                SharpFormTextField::make("postal_code")
                    ->setLabel("Code postal")
                    ->setMaxLength(5)
            )
            ->addField(
                SharpFormTextField::make("altitude")
                    ->setLabel("Altitude")
                    ->setMaxLength(4)
                    ->setHelpMessage("En mètres")
            )
            ->addField(
                SharpFormTextField::make("creation_date")
                    ->setLabel("Date de mise en service")
                    ->setHelpMessage('Peut être approximative, ex: "début 2008", "mars 2012", "automne 2005", etc')
            )
            ->addField(
                SharpFormTextareaField::make("description")
                    ->setLabel("Description")
                    ->setRowCount(4)
            )
            ->addField(
                SharpFormTextareaField::make("hardware_details")
                    ->setLabel("Détails du matériel utilisé")
                    ->setMaxLength(300)
                    ->setRowCount(4)
            )
            ->addField(
                SharpFormTextField::make("website_url")
                    ->setLabel("Lien vers un site web externe")
                    ->setMaxLength(300)
                ->setHelpMessage('exemple: https://www.meteociel.fr/station/198523')
            );
    }

    function buildFormLayout(FormLayout $formLayout): void
    {
        $formLayout
            ->addColumn(6, function(FormLayoutColumn $column) {
                $column
                    ->withFields("name")
                    ->withFields("description")
                    ->withFields("creation_date")
                    ->withFields("hardware_details")
                    ->withFields("city")
                    ->withFields("postal_code")
                    ->withFields("altitude")
                    ->withFields("website_url");
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
        $this->setDisplayShowPageAfterCreation();
    }

    protected function setDisplayShowPageAfterCreation(bool $displayShowPage = true): self
    {
        $this->displayShowPageAfterCreation = $displayShowPage;

        return $this;
    }

    function find($id): array
    {
        return $this
            ->setCustomTransformer("visuals", new SharpUploadModelFormAttributeTransformer())
            ->transform(WeatherStation::with('visuals')->findOrFail($id));
    }

    function update($id, array $data)
    {
        $station = $id
            ? WeatherStation::findOrFail($id)
            : new WeatherStation([
                "user_id" => auth()->id(),
            ]);

        $this->save($station, $data);

        return $station->id;
    }

    public function delete($id): void
    {
        WeatherStation::findOrFail($id)->delete();
    }
}
