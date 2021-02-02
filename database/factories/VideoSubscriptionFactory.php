<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VideoSubscriptionFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => function () {
                return rand(1, 10);
            },
            'video_id' => function () {
                return rand(1, 50);
            }
        ];
    }
}
