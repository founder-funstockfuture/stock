<?php

namespace Database\Factories;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;


class VideoFactory extends Factory
{
    protected $model = Video::class;

    public function definition()
    {

        $video = $this->faker->randomElement([
            "https://www.youtube.com/watch?v=UeB1OxTo3Ec&ab_channel=%E7%94%9C%E7%BE%8E%E7%9A%84%E6%97%8B%E5%BE%8BSweetMelody",
            "https://www.youtube.com/watch?v=GcSa2cy__9E&ab_channel=KKBOX%E8%8F%AF%E8%AA%9E%E6%96%B0%E6%AD%8C-kkboxmusic",
            "https://www.youtube.com/watch?v=uzhggWwV7KA&ab_channel=%E7%94%9C%E7%BE%8E%E7%9A%84%E6%97%8B%E5%BE%8BSweetMelody",
            "https://www.youtube.com/watch?v=gbvu9h_nN7M&t=12s&ab_channel=LucasMusic",
            "https://www.youtube.com/watch?v=1pY-vcq3z9c&ab_channel=WayneRojak",
            "https://www.youtube.com/watch?v=gbvu9h_nN7M&ab_channel=LucasMusic",
            "https://www.youtube.com/watch?v=A8tl4cZq7V0&ab_channel=%E9%82%A3%E4%BA%9B%E5%A5%BD%E5%90%AC%E7%9A%84%E6%AD%8C",
            "https://www.youtube.com/watch?v=QHVe_oED0ok&ab_channel=cnss2018s7",
            "https://www.youtube.com/watch?v=oYZeqrDbmxQ&ab_channel=NEWKKBOXII",
        ]);



        $sentence = $this->faker->sentence();
        $on_sale = $this->faker->randomElement([0, 1]);
        
        return [
            'title' => $sentence,
            'youtube_url' => $video,
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
}
