<?php

namespace App\Sharp\Admin\User;

use Code16\Sharp\Utils\Entities\SharpEntity;

class UserEntity extends SharpEntity
{
    protected ?string $list = UserList::class;
    protected ?string $show = UserShow::class;
    protected ?string $form = UserForm::class;
    protected ?string $policy = UserPolicy::class;
    protected string $label = "Utilisateurs";

}
