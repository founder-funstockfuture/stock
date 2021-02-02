<?php

namespace Database\Factories;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;


class TopicFactory extends Factory
{
    protected $model = Topic::class;

    public function definition()
    {
        $sentence = $this->faker->sentence();
        $on_sale = $this->faker->randomElement([0, 1]);
        
        return [
            'title' => $sentence,
            'body' => $this->faker->text(),
            'excerpt' => $sentence,
            'user_id' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
            'category_id' => $this->faker->randomElement([1, 2, 3, 4]),
            'on_sale' => $on_sale,
            'coin' => $on_sale == 1 ? $this->faker->numberBetween(100, 2000):0,
            'pay_count' => $this->faker->numberBetween(0, 10),
            'is_show' => $this->faker->randomElement([0, 1]),
            'published_at' => Carbon::parse('-1 week')
        ];
    }

    public function published()
    {
        return $this->state([
            'is_show'=>'1',
            'is_blocked'=>'0',
            'published_at' => Carbon::parse('-1 week')
        ]);
    }

    public function unpublished()
    {
        return $this->state([
            'is_show'=>'1',
            'is_blocked'=>'0',
            'published_at' => null
        ]);
    }


}