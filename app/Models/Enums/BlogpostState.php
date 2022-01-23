<?php

namespace App\Models\Enums;

enum BlogpostState: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';

    public function label(): string
    {
        return match($this)
        {
            self::DRAFT => 'Brouillon',
            self::PUBLISHED => 'En ligne',
        };
    }
}
