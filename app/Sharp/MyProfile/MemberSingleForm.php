<?php

namespace App\Sharp\MyProfile;

use Code16\Sharp\Form\Eloquent\Uploads\Transformers\SharpUploadModelFormAttributeTransformer;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Fields\SharpFormUploadField;
use Code16\Sharp\Form\Layout\FormLayout;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\SharpSingleForm;
use Code16\Sharp\Utils\Fields\FieldsContainer;

class MemberSingleForm extends SharpSingleForm
{
    use WithSharpFormEloquentUpdater;

    protected ?string $formValidatorClass = MemberValidator::class;

    function buildFormFields(FieldsContainer $formFields) : void
    {
        $formFields
            ->addField(
                SharpFormUploadField::make("avatar")
                    ->setLabel("Visuel")
                    ->setFileFilterImages()
                    ->setMaxFileSize(1)
                    ->shouldOptimizeImage()
                    ->setStorageDisk("local")
                    ->setCropRatio("1:1")
                    ->setStorageBasePath("data/User/{id}")
            )
            ->addField(
                SharpFormTextField::make("name")
                    ->setLabel("Nom")
                    ->setMaxLength(300)
                ->setHelpMessage("Vous êtes libre d'utiliser des initials ou un surnom si vous ne souhaitez pas affciher votre votre nom complet sur le site. ex: Arnaud B.")
            )
            ->addField(
                SharpFormTextField::make("email")
                    ->setLabel("Adresse email")
                    ->setMaxLength(150)
                    ->setReadOnly()
            );
    }

    function buildFormLayout(FormLayout $formLayout): void
    {
        $formLayout
            ->addColumn(6, function(FormLayoutColumn $column) {
                $column
                    ->withFields("name")
                    ->withFields("email");
            })
            ->addColumn(6, function(FormLayoutColumn $column) {
                $column
                    ->withSingleField("avatar");
            });
    }

    function findSingle(): array
    {
        return $this
            ->setCustomTransformer("avatar", new SharpUploadModelFormAttributeTransformer())
            ->transform(auth()->user());
    }

    protected function updateSingle(array $data)
    {
        $user = auth()->user();

        $this->save($user, $data);

        return $user->id;
    }
}
