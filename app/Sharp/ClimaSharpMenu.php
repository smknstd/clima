<?php

namespace App\Sharp;

use Code16\Sharp\Utils\Menu\SharpMenu;
use Code16\Sharp\Utils\Menu\SharpMenuItemSection;

class ClimaSharpMenu extends SharpMenu
{
    public function build(): self
    {
        return $this
            ->addEntityLink("member", "Mon compte", "fas fa-user")
            ->addEntityLink("my_station", "Ma station", "fas fa-podcast")
            ->addEntityLink("my_daily_reports", "Mes relevés", "fas fa-thermometer-half")
            ->addSection("Administration", function(SharpMenuItemSection $section) {
                $section
                    ->addEntityLink("user", "Utilisateurs", "fas fa-user")
                    ->addEntityLink("stations", "Stations", "fas fa-podcast")
                    ->addEntityLink("daily_reports", "Relevés", "fas fa-thermometer-half");
            });
    }
}
