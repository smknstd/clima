<?php

namespace App\Sharp\Admin\User;

use App\Models\Enums\UserRole;
use Code16\Sharp\Form\Validator\SharpFormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use function currentSharpRequest;

class UserValidator extends SharpFormRequest
{
    public function rules(): array
    {
        return [
            "name" => [
                "required",
                "max:300",
            ],
            "email" => [
                "required",
                "email",
                "max:150",
                Rule::unique("users", "email")
                    ->ignore(currentSharpRequest()->instanceId()),
            ],
            "role" => [
                "required",
                new Enum(UserRole::class),
            ],
        ];
    }
}


