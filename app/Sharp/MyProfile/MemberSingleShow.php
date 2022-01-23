<?php

namespace App\Sharp\MyProfile;

use App\Models\User;
use Code16\Sharp\Show\Fields\SharpShowPictureField;
use Code16\Sharp\Show\Fields\SharpShowTextField;
use Code16\Sharp\Show\Layout\ShowLayout;
use Code16\Sharp\Show\Layout\ShowLayoutColumn;
use Code16\Sharp\Show\Layout\ShowLayoutSection;
use Code16\Sharp\Show\SharpSingleShow;
use Code16\Sharp\Utils\Fields\FieldsContainer;
use Code16\Sharp\Utils\Transformers\Attributes\Eloquent\SharpUploadModelThumbnailUrlTransformer;

class MemberSingleShow extends SharpSingleShow
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
                SharpShowPictureField::make("avatar")
            )
            ->addField(
                SharpShowTextField::make('description')
                    ->setLabel('Description')
            )
            ->addField(
                SharpShowTextField::make('website_url')
                    ->setLabel('Lien vers un site web externe')
            );
    }

    protected function buildShowLayout(ShowLayout $showLayout): void
    {
        $showLayout
            ->addSection('Informations', function (ShowLayoutSection $section) {
                $section
                    ->addColumn(6, function (ShowLayoutColumn $column) {
                        $column
                            ->withSingleField('name')
                            ->withSingleField('email')
                            ->withSingleField('description')
                            ->withSingleField('website_url');
                    })
                    ->addColumn(6, function (ShowLayoutColumn $column) {
                        $column
                            ->withSingleField('avatar');
                    });
            });
    }

    public function findSingle(): array
    {
        return $this
            ->setCustomTransformer("website_url", function ($value, User $user) {
                return sprintf("<a href='%s'>%s</a>", $value, $value);
            })
            ->setCustomTransformer("avatar", new SharpUploadModelThumbnailUrlTransformer(140))
            ->transform(auth()->user());
    }
}
