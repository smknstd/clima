<?php

namespace App\Sharp;

use Code16\Sharp\Utils\Menu\SharpMenu;

class ClimaSharpMenu extends SharpMenu
{
    public function build(): self
    {
        return $this
            ->addEntityLink("user", "Utilisateurs", "fas fa-user")
            ->addEntityLink("member", "Mon compte", "fas fa-user")
            ->addEntityLink("station", "Mes stations", "fas fa-thermometer-half");
    }
}
