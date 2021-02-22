<?php

namespace Database\Factories;

//use App\Models\Topic;
use App\Models\Reply2;
use Illuminate\Database\Eloquent\Factories\Factory;

class Reply2Factory extends Factory
{
    protected $model = Reply2::class;

    public function definition()
    {
        $reply_id = rand(1, 100);

        return [
            'content' => $this->faker->sentence(),
            'reply_id' => $reply_id,
            'user_id' => rand(1, 10),
        ];
    }
}