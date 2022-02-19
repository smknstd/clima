<?php

namespace App\Sharp\MyBlogposts;

use App\Models\Enums\BlogpostType;
use Code16\Sharp\Utils\Entities\SharpEntity;

class BlogpostEntity extends SharpEntity
{
    protected ?string $list = BlogpostList::class;
    protected ?string $policy = BlogpostPolicy::class;
    protected string $label = "Blog";

    public function getMultiforms(): array
    {
        return [
            BlogpostType::NEWS->value => [NewsForm::class, "Brève"],
            BlogpostType::SINGLE_PHOTO->value => [SinglePhotoForm::class, "Photo"],
            BlogpostType::REVIEW->value => [ReviewForm::class, "Bilan périodique"],
        ];
    }
}
