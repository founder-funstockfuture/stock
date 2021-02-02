<?php

namespace Database\Factories;

use App\Models\Charity;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharityFactory extends Factory
{

    protected $model = Charity::class;

    public function definition()
    {
        return [
            'love_name'  => $this->faker->sentence,
            'love_code'       => $this->faker->randomNumber(5),
            'enabled' => $this->faker->numberBetween(0, 1)
        ];
    }
}
