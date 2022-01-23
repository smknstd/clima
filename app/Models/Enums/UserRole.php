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
        $array = [];
        foreach (self::cases() as $enum) {
            $array[$enum->value] = $enum->label();
        }
        return $array;
    }
}
