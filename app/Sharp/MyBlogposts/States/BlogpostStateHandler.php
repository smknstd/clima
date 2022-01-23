<?php

namespace App\Sharp\MyBlogposts\States;

use App\Models\Enums\BlogpostState;
use Code16\Sharp\EntityList\Commands\EntityState;

class BlogpostStateHandler extends EntityState
{
    protected function buildStates(): void
    {
        $this
            ->addState(BlogpostState::PUBLISHED->value, BlogpostState::PUBLISHED->label(), "#5596E6")
            ->addState(BlogpostState::DRAFT->value, BlogpostState::DRAFT->label(), "#8C9BA5");
    }

    protected function updateState($instanceId, $stateId): array
    {
        BlogpostState::findOrFail($instanceId)->update([
            "state" => $stateId
        ]);

        return $this->refresh($instanceId);
    }
}
