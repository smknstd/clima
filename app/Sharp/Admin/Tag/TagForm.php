<?php

namespace App\Sharp\Admin\Tag;


use App\Models\Enums\FederationEnum;
use App\Models\Enums\OrganizationTypeEnum;
use App\Models\Enums\StateEnum;
use App\Models\Enums\UserRole;
use App\Models\User;
use App\Sharp\User\Transformers\UserRolesTransformer;
use Code16\Sharp\Form\Eloquent\Uploads\Transformers\SharpUploadModelFormAttributeTransformer;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormSelectField;
use Code16\Sharp\Form\Fields\SharpFormTextareaField;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Fields\SharpFormUploadField;
use Code16\Sharp\Form\Layout\FormLayout;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\SharpForm;
use Code16\Sharp\Utils\Fields\FieldsContainer;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
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
        /** @var User $user */
        $user = User::findOrFail($id);

        $user->logout(); //@todo does it work ?
        $user->delete();

    }
}
