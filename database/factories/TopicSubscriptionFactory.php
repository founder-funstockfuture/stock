<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TopicSubscriptionFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => function () {
                return rand(1, 10);
            },
            'topic_id' => function () {
                return rand(1, 100);
            }
        ];
    }
}
