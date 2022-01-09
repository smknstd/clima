<?php

namespace Database\Seeders;

use App\Models\Enums\UserRole;
use App\Models\Media;
use App\Models\User;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * The current Faker instance.
     *
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * Create a new seeder instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->faker = $this->withFaker();
    }

    /**
     * Get a new Faker instance.
     *
     * @return \Faker\Generator
     */
    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()->create([
            "email" => "admin@example.org",
            "role" => UserRole::ADMIN->value
        ]);

        $adminAvatarFilename = $this->faker->image(
            storage_path("app/data"),
            600,
            600
        );

        Media::factory([
            'model_id' => $admin->id,
            "model_type" => User::class,
            "model_key" => "avatar",
        ])
            ->withFile($adminAvatarFilename)
            ->create();

        $member = User::factory()->create([
            "email" => "member@example.org",
            "role" => UserRole::USER->value
        ]);

        $memberAvatarFilename = $this->faker->image(
            storage_path("app/data"),
            600,
            600
        );

        Media::factory([
            'model_id' => $member->id,
            "model_type" => User::class,
            "model_key" => "avatar",
        ])
            ->withFile($memberAvatarFilename)
            ->create();
    }
}
