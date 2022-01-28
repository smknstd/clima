<?php

namespace App\Sharp\MyBlogposts;

use Code16\Sharp\Form\Validator\SharpFormRequest;

class SinglePhotoValidator extends SharpFormRequest
{
    public function rules(): array
    {
        return [
            "title" => [
                "required",
                "max:300"
            ],
            "cover" => [
                "required",
            ],
        ];
    }
}


