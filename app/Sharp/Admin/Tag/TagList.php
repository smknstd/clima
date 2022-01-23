<?php

namespace App\Sharp\Admin\Tag;

use App\Models\Blogpost;
use App\Models\User;
use App\Sharp\Admin\User\Commands\MemberImpersonateCommand;
use App\Sharp\Admin\User\Commands\UserSetPassword;
use Code16\Sharp\EntityList\Fields\EntityListField;
use Code16\Sharp\EntityList\Fields\EntityListFieldsContainer;
use Code16\Sharp\EntityList\Fields\EntityListFieldsLayout;
use Code16\Sharp\EntityList\SharpEntityList;
use Illuminate\Contracts\Support\Arrayable;
use Spatie\Tags\Tag;

class TagList extends SharpEntityList
{
    public function buildListFields(EntityListFieldsContainer $fieldsContainer): void
    {
        $fieldsContainer
            ->addField(
                EntityListField::make("name")
                    ->setLabel("Nom")
            )
            ->addField(
                EntityListField::make("posts_count")
                    ->setLabel("Nombre de posts")
            );
    }

    public function buildListLayout(EntityListFieldsLayout $fieldsLayout): void
    {
        $fieldsLayout
            ->addColumn("name", 9)
            ->addColumn("posts_count", 3);
    }

    public function buildListConfig(): void
    {
    }

    function getInstanceCommands(): ?array
    {
        return [];
    }

    function getEntityCommands(): ?array
    {
        return [];
    }

    public function getListData(): array|Arrayable
    {
        return $this
            ->setCustomTransformer("name", function ($value, Tag $tag) {
                return $tag->name;
            })
            ->setCustomTransformer("posts_count", function ($value, Tag $tag) {
                return Blogpost::withAnyTags([$tag->name])->count();
            })
            ->transform(Tag::orderBy('created_at','desc')->get());
    }
}
