<?php

namespace App\Models\Enums;

enum UserRole: string
{
    case USER = 'user';
    case ADMIN = 'admin';

    public function label(): string
    {
        return match($this)
        {
            self::USER => 'Membre',
            self::ADMIN => 'Administrateur',
        };
    }

    public static function getAllRolesAsArray(): array
    {
        return [
            self::USER->value => self::USER->label(),
            self::ADMIN->value => self::ADMIN->label(),
        ];
    }
}
