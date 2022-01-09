<?php

namespace App\Sharp\User\Commands;

use App\Models\User;
use Code16\Sharp\EntityList\Commands\InstanceCommand;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Utils\Fields\FieldsContainer;
use Illuminate\Support\Facades\Hash;

class UserSetPassword extends InstanceCommand
{

    public function label(): ?string
    {
        return "Définir le mot de passe...";
    }

    public function buildFormFields(FieldsContainer $formFields): void
    {
        $formFields->addField(
            SharpFormTextField::make("password")
                ->setLabel("Mot de passe")
                ->setHelpMessage("8 caractères minimum ; le texte présenté est une proposition de mot de passe, automatiquement générée. Il ne s'agit PAS du mot de passe actuel.")
        );
    }

    protected function initialData($instanceId): array
    {
        $random = 'abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%&-_';

        return [
            "password" => substr(str_shuffle($random . $random . $random), 0, 8)
        ];
    }

    public function execute($instanceId, array $data = []): array
    {
        $this->validate($data, [
            "password" => [
                "min:8",
                "max:64"
            ]
        ]);

        User::findOrFail($instanceId)->update([
            "password" => Hash::make($data["password"])
        ]);

        return $this->refresh($instanceId);
    }

    public function authorizeFor($instanceId): bool
    {
        return auth()->user()->isAdmin();
    }
}
