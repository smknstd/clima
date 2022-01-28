<?php

namespace App\Sharp\Admin\Tag;


use App\Models\User;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Layout\FormLayout;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\SharpForm;
use Code16\Sharp\Utils\Fields\FieldsContainer;
use Spatie\Tags\Tag;

class TagForm extends SharpForm
{
    use WithSharpFormEloquentUpdater;

    function buildFormFields(FieldsContainer $formFields) : void
    {
        $formFields
            ->addField(
                SharpFormTextField::make("name")
                    ->setLabel("Nom")
                    ->setMaxLength(100)
            );
    }

    function buildFormLayout(FormLayout $formLayout): void
    {
        $formLayout
            ->addColumn(6, function(FormLayoutColumn $column) {
                $column
                    ->withFields("name");
            });
    }

    public function buildFormConfig(): void
    {
    }

    function find($id): array
    {
        return $this
            ->setCustomTransformer("name", function ($value, Tag $tag) {
                return $tag->name;
            })
            ->transform(Tag::findOrFail($id));
    }

    function update($id, array $data)
    {
        $tag = $id
            ? Tag::findOrFail($id)
            : new Tag();

        $this->save($tag, $data);

        return $tag->id;
    }

    public function delete($id): void
    {
        Tag::find($id)->delete();
    }
}
