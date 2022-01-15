<?php

namespace App\Sharp\User\Commands;

use App\Models\User;
use Code16\Sharp\EntityList\Commands\InstanceCommand;
use Code16\Sharp\Utils\Links\LinkToSingleShowPage;

class MemberImpersonateCommand extends InstanceCommand
{

    /**
     * @return string
     */
    public function label(): string
    {
        return "Se connecter en tant que...";
    }

    /**
     * @return null|string
     */
    public function confirmationText(): string
    {
        return "Se connecter en tant que ce membre. Vous êtes sûr ?";
    }

    /**
     * @param string $instanceId
     * @param array $data
     * @return array
     */
    public function execute($instanceId, array $data = []): array
    {
        auth()->logout();
        auth()->loginUsingId($instanceId);

        return $this->link(LinkToSingleShowPage::make('member')->renderAsUrl());
    }

    /**
     * @param $instanceId
     * @return bool
     */
    public function authorizeFor($instanceId): bool
    {
        return auth()->user()->isAdmin() && $instanceId !== auth()->id();
    }
}
