<?php

namespace App\Sharp\User;

use App\Models\User;
use App\Sharp\User\Commands\MemberImpersonateCommand;
use App\Sharp\User\Commands\UserSetPassword;
use Code16\Sharp\EntityList\Fields\EntityListField;
use Code16\Sharp\EntityList\Fields\EntityListFieldsContainer;
use Code16\Sharp\EntityList\Fields\EntityListFieldsLayout;
use Code16\Sharp\EntityList\SharpEntityList;
use Illuminate\Contracts\Support\Arrayable;

class UserList extends SharpEntityList
{
    public function buildListFields(EntityListFieldsContainer $fieldsContainer): void
    {
        $fieldsContainer
            ->addField(
                EntityListField::make("name")
                    ->setSortable()
                    ->setLabel("Nom")
            )
            ->addField(
                EntityListField::make("email")
                    ->setLabel("Email")
            )
            ->addField(
                EntityListField::make("role")
                    ->setLabel("Droits")
            )
            ->addField(
                EntityListField::make("created_at")
                    ->setLabel("Création")
            );
    }

    public function buildListLayout(EntityListFieldsLayout $fieldsLayout): void
    {
        $fieldsLayout
            ->addColumn("name", 3)
            ->addColumn("email", 3)
            ->addColumn("role", 3)
            ->addColumn("created_at", 3);
    }

    public function buildListConfig(): void
    {
        $this
            ->configurePaginated()
            ->configureDefaultSort("created_at", "desc")
            ->configureSearchable();
    }

    function getInstanceCommands(): ?array
    {
        return [
            "set-password" => new UserSetPassword(),
            "impersonate" => new MemberImpersonateCommand(),
        ];
    }

    function getEntityCommands(): ?array
    {
        return [];
    }

    public function getListData(): array|Arrayable
    {
        $users = User::orderBy($this->queryParams->sortedBy(), $this->queryParams->sortedDir());

        $users->when($this->queryParams->hasSearch(), function ($posts) {
            foreach ($this->queryParams->searchWords() as $word) {
                $posts->where(function ($query) use ($word) {
                    $query
                        ->orWhere("name", "like", $word)
                        ->orWhere("email", "like", $word);
                });
            }
        });


        return $this
            ->setCustomTransformer("created_at", function ($value, User $user) {
                return $user->created_at->format("d/m/y H:i");
            })
            ->setCustomTransformer("role", function ($value, User $user) {
                return $user->role->label();
            })
            ->transform($users->paginate(25));
    }
}
