<?php

namespace App\Sharp\MyBlogposts;

use App\Models\Enums\UserRole;
use Code16\Sharp\Form\Validator\SharpFormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class NewsValidator extends SharpFormRequest
{
    public function rules(): array
    {
        return [
            "title" => [
                "required",
                "max:300"
            ],
            "published_at" => [
                "required",
            ],
            "content" => [
                "required",
            ],
            "cover" => [
                "required",
            ],
        ];
    }
}


