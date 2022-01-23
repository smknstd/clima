<?php

namespace App\Sharp\Admin\Tag;

use Code16\Sharp\Utils\Entities\SharpEntity;

class TagEntity extends SharpEntity
{
    protected ?string $list = TagList::class;
    protected ?string $form = TagForm::class;
    protected ?string $policy = TagPolicy::class;
    protected string $label = "Tags";

}
