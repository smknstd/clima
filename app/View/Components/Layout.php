<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Layout extends Component
{

    public function __construct(
        public ?string $activeNav = null,
    ) {

    }

    public function metaTitle($siteName, $title = null): string
    {
        if(trim($title)) {
            return sprintf('%s | %s', $title, $siteName);
        }
        return $siteName;
    }

    public function render()
    {
        return view('layouts.app', [
            'layout' => $this,
        ]);
    }
}
