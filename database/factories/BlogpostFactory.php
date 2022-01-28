<?php

namespace Database\Factories;

use App\Models\Enums\BlogpostState;
use App\Models\Enums\BlogpostType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogpostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => 'Mon article de blog',
            'slug' => 'mon-article-de-blog',
            'state' => BlogpostState::PUBLISHED,
            'type' => BlogpostType::NEWS,
            'content' => "Super, excellent !",
            'published_at' => Carbon::now(),
        ];
    }
}
