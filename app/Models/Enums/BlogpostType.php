<?php

namespace App\Models\Enums;

enum BlogpostType: string
{
    case NEWS = 'news';
    case SINGLE_PHOTO = 'photo';
    case REVIEW = 'review';

    public function label(): string
    {
        return match($this)
        {
            self::NEWS => 'Brève',
            self::SINGLE_PHOTO => 'Photo',
            self::REVIEW => 'Bilan périodique',
        };
    }
}
