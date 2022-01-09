<?php

namespace App\Sharp\Member;

use Code16\Sharp\Utils\Entities\SharpEntity;

class MemberEntity extends SharpEntity
{
    protected bool $isSingle = true;
    protected ?string $show = MemberSingleShow::class;
    protected ?string $form = MemberSingleForm::class;
    protected ?string $policy = MemberPolicy::class;
    protected string $label = "Mon compte";

}
