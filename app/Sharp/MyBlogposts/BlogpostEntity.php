<?php

namespace App\Sharp\MyBlogposts;

use Code16\Sharp\Utils\Entities\SharpEntity;

class BlogpostEntity extends SharpEntity
{
    protected ?string $list = BlogpostList::class;
//    protected ?string $show = BlogpostShow::class;
    protected ?string $policy = BlogpostPolicy::class;
    protected string $label = "Blog";

}
