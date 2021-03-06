<?php

namespace Database\Seeders;

use App\Models\Blogpost;
use App\Models\Enums\UserRole;
use App\Models\Media;
use App\Models\User;
use App\Models\WeatherDailyReport;
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
            "city" => "Haegen",
            "postal_code" => "67700",
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
            "city" => "Hultehouse",
            "postal_code" => "57820",
        ]);

        $this->seedBlogpost($admin);
        $this->seedBlogpost($member);
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

        for ($i=0;$i<50;$i++) {
            $report = WeatherDailyReport::factory()->create([
                "weather_station_id" => $station->id,
                "date" => today()->subDays($i),
            ]);

            if ($i === 1) {
                $reportVisualFilename = $this->faker->image(
                    storage_path("app/data"),
                    1024,
                    750
                );

                Media::factory([
                    'model_id' => $report->id,
                    "model_type" => WeatherDailyReport::class,
                    "model_key" => "visuals",
                ])
                    ->withFile($reportVisualFilename)
                    ->create();
            }
        }
    }

    private function seedBlogpost(User $user, array $blogpostAttributes = [])
    {
        $blogpost = Blogpost::factory()->create([
            "user_id" => $user->id,
            ...$blogpostAttributes
        ]);

        $blogpostVisualFilename = $this->faker->image(
            storage_path("app/data"),
            1024,
            750
        );

        Media::factory([
            'model_id' => $blogpost->id,
            "model_type" => Blogpost::class,
            "model_key" => "cover",
        ])
            ->withFile($blogpostVisualFilename)
            ->create();
    }
}
