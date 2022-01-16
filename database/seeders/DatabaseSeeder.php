<?php

namespace Database\Seeders;

use App\Models\Enums\UserRole;
use App\Models\Media;
use App\Models\User;
use App\Models\WeatherStation;
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

        $this->seedWeatherStation($admin, [
            "name" => "Station #1",
            "city" => "Haegen",
            "postal_code" => "67700",
        ]);

        $this->seedWeatherStation($admin, [
            "name" => "Station #2",
            "city" => "Saverne",
            "postal_code" => "67100",
        ]);

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

        $this->seedWeatherStation($member, [
            "name" => "Vantage",
            "city" => "Hultehouse",
            "postal_code" => "57820",
        ]);
    }

    private function seedWeatherStation(User $user, array $stationAttributes = [])
    {
        $station = WeatherStation::factory()->create([
            "user_id" => $user->id,
            ...$stationAttributes
        ]);

        for ($i=0;$i<3;$i++) {
            $stationVisualFilename = $this->faker->image(
                storage_path("app/data"),
                1024,
                750
            );

            Media::factory([
                'model_id' => $station->id,
                "model_type" => WeatherStation::class,
                "model_key" => "visuals",
            ])
                ->withFile($stationVisualFilename)
                ->create();
        }
    }
}
