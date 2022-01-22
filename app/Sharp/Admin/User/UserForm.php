<?php

namespace App\Sharp\Admin\User;

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

class UserForm extends SharpForm
{
    use WithSharpFormEloquentUpdater;

    protected ?string $formValidatorClass = UserValidator::class;

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
            )
            ->addField(
                SharpFormTextField::make("email")
                    ->setLabel("Adresse email")
                    ->setMaxLength(150)
            )
            ->addField(
                SharpFormTextareaField::make("description")
                    ->setLabel("Description")
                    ->setRowCount(4)
            )
            ->addField(
                SharpFormTextField::make("website_url")
                    ->setLabel("Lien vers un site web externe")
                    ->setMaxLength(300)
            )
            ->addField(
                SharpFormSelectField::make(
                    "role",
                    UserRole::getAllRolesAsArray()
                )
                    ->setLabel("Droits")
            );
    }

    function buildFormLayout(FormLayout $formLayout): void
    {
        $formLayout
            ->addColumn(6, function(FormLayoutColumn $column) {
                $column
                    ->withFields("name")
                    ->withFields("email")
                    ->withFields("description")
                    ->withFields("website_url");
            })
            ->addColumn(6, function(FormLayoutColumn $column) {
                $column
                    ->withSingleField("role")
                    ->withSingleField("avatar");
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
            ->setCustomTransformer("role", function($value, User $user) {
                return $user->role->value;
            })
            ->setCustomTransformer("avatar", new SharpUploadModelFormAttributeTransformer())
            ->transform(User::with('avatar')->findOrFail($id));
    }

    function update($id, array $data)
    {
        $user = $id
            ? User::findOrFail($id)
            : new User([
                "password" => Str::random()
            ]);

        $this->save($user, $data);

        if(!$id) {
            $this->notify("L’utilisateur a été créé! Utilisez la commande de choix du mot de passe pour lui en définir un.");
        }

        return $user->id;
    }

    public function delete($id): void
    {
        /** @var User $user */
        $user = User::findOrFail($id);

        $user->logout(); //@todo does it work ?
        $user->delete();

    }
}
