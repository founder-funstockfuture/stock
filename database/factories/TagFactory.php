<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{

    protected $model = Tag::class;

    public function definition()
    {
        return [
            'user_id'  => rand(1, 10),
            'tag_name' => $this->faker->word,
        ];
    }
}
