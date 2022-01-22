<?php

namespace App\Sharp\Admin\User;

use App\Models\User;
use App\Sharp\Admin\User\Commands\UserSetPassword;
use Code16\Sharp\Show\Fields\SharpShowPictureField;
use Code16\Sharp\Show\Fields\SharpShowTextField;
use Code16\Sharp\Show\Layout\ShowLayout;
use Code16\Sharp\Show\Layout\ShowLayoutColumn;
use Code16\Sharp\Show\Layout\ShowLayoutSection;
use Code16\Sharp\Show\SharpShow;
use Code16\Sharp\Utils\Fields\FieldsContainer;
use Code16\Sharp\Utils\Transformers\Attributes\Eloquent\SharpUploadModelThumbnailUrlTransformer;

class UserShow extends SharpShow
{
    protected function buildShowFields(FieldsContainer $showFields): void
    {
        $showFields
            ->addField(
                SharpShowTextField::make('name')
                    ->setLabel('Nom')
            )
            ->addField(
                SharpShowTextField::make('email')
                    ->setLabel('Email')
            )
            ->addField(
                SharpShowTextField::make('description')
                    ->setLabel('Description')
            )
            ->addField(
                SharpShowTextField::make('website_url')
                    ->setLabel('Lien vers un site web externe')
            )
            ->addField(
                SharpShowTextField::make('created_at')
                    ->setLabel('Création')
            )
            ->addField(
                SharpShowTextField::make('role')
                    ->setLabel('Droits')
            )
            ->addField(
                SharpShowPictureField::make("avatar")
            );
    }

    protected function buildShowLayout(ShowLayout $showLayout): void
    {
         $showLayout
             ->addSection('Informations', function(ShowLayoutSection $section) {
                 $section
                     ->addColumn(6, function(ShowLayoutColumn $column) {
                         $column
                             ->withSingleField('name')
                             ->withSingleField('email')
                             ->withSingleField('description')
                             ->withSingleField('website_url');
                     })
                     ->addColumn(6, function(ShowLayoutColumn $column) {
                         $column
                             ->withSingleField('avatar');
                     });
             })
             ->addSection('Details', function(ShowLayoutSection $section) {
                 $section
                     ->addColumn(6, function(ShowLayoutColumn $column) {
                         $column
                             ->withSingleField('role');
                     })
                     ->addColumn(6, function(ShowLayoutColumn $column) {
                         $column
                             ->withSingleField('created_at');
                     });
             });
//             ->addEntityListSection("debates");
    }

    public function buildShowConfig(): void
    {
        $this
            ->configureBreadcrumbCustomLabelAttribute("name");
    }

    public function getInstanceCommands(): ?array
    {
        return [
            "set-password" => new UserSetPassword()
        ];
    }

    public function find($id): array
    {
        return $this
            ->setCustomTransformer("created_at", function ($value, User $user) {
                return $user->created_at->format("d/m/y H:i");
            })
            ->setCustomTransformer("description", function ($value, User $user) {
                return $value ?? '<i>Non renseigné</i>';
            })
            ->setCustomTransformer("role", function ($value, User $user) {
                return $user->role->label();
            })
            ->setCustomTransformer("website_url", function ($value, User $user) {
                return sprintf("<a href='%s'>%s</a>", $value, $value);
            })
            ->setCustomTransformer("avatar", new SharpUploadModelThumbnailUrlTransformer(140))
            ->transform(User::findOrFail($id));
    }
}
