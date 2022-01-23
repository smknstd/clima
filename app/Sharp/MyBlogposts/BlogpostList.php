<?php

namespace App\Sharp\MyBlogposts;

use App\Models\Blogpost;
use App\Sharp\MyBlogposts\States\BlogpostStateHandler;
use Code16\Sharp\EntityList\Fields\EntityListField;
use Code16\Sharp\EntityList\Fields\EntityListFieldsContainer;
use Code16\Sharp\EntityList\Fields\EntityListFieldsLayout;
use Code16\Sharp\EntityList\SharpEntityList;
use Code16\Sharp\Utils\Transformers\Attributes\Eloquent\SharpUploadModelThumbnailUrlTransformer;
use Illuminate\Contracts\Support\Arrayable;


class BlogpostList extends SharpEntityList
{
    public function buildListFields(EntityListFieldsContainer $fieldsContainer): void
    {
        $fieldsContainer
            ->addField(
                EntityListField::make("created_at")
                    ->setLabel("Création")
            )
            ->addField(
                EntityListField::make("published_at")
                    ->setLabel("Publication")
            )
            ->addField(
                EntityListField::make("cover")
            )
            ->addField(
                EntityListField::make("type")
                    ->setLabel("Type")
            )
            ->addField(
                EntityListField::make("title")
                    ->setLabel("Titre")
            );
    }

    public function buildListLayout(EntityListFieldsLayout $fieldsLayout): void
    {
        $fieldsLayout
            ->addColumn("cover", 1)
            ->addColumn("created_at", 2)
            ->addColumn("published_at", 2)
            ->addColumn("type", 1)
            ->addColumn("title", 6);
    }


    public function buildListConfig(): void
    {
        $this
            ->configureEntityState("blogpost_state", new BlogpostStateHandler())
            ->configureSearchable()
            ->configurePaginated();
    }

    public function getListData(): array|Arrayable
    {
        $posts = Blogpost::where('user_id', auth()->id())
            ->orderBy('published_at', 'desc')
            ->when($this->queryParams->hasSearch(), function ($posts) {
                foreach ($this->queryParams->searchWords() as $word) {
                    $posts->where(function ($query) use ($word) {
                        $query
                            ->orWhere("title", "like", $word)
                            ->orWhere("slug", "like", $word);
                    });
                }
            });


        return $this
            ->setCustomTransformer("type", function ($value, Blogpost $post) {
                return $post->type->label();
            })
            ->setCustomTransformer("created_at", function ($value, Blogpost $post) {
                return $post->created_at->format("d/m/y H:i");
            })
            ->setCustomTransformer("published_at", function ($value, Blogpost $post) {
                return $post->created_at->format("d/m/y H:i");
            })
            ->setCustomTransformer("cover", (new SharpUploadModelThumbnailUrlTransformer(100))->renderAsImageTag())
            ->transform(
                $posts->paginate(25)
            );
    }
}
