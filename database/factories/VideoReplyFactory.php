<?php

namespace Database\Factories;

use App\Models\Video;
use App\Models\VideoReply;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoReplyFactory extends Factory
{
    protected $model = VideoReply::class;

    public function definition()
    {
        $video_id = rand(1, 100);
        
        if($video = Video::find($video_id)){
            $video->reply_count+=1;
            $video->save();

        }

        return [
            'content' => $this->faker->sentence(),
            'video_id' => $video_id,
            'user_id' => rand(1, 10),
        ];
    }
}