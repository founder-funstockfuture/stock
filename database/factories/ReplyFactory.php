<?php

namespace Database\Factories;

use App\Models\Topic;
use App\Models\Reply;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    protected $model = Reply::class;

    public function definition()
    {

        $topic_id = rand(1, 100);
        
        if($topic = Topic::find($topic_id)){
            $topic->reply_count+=1;
            $topic->save();

        }

        return [
            'content' => $this->faker->sentence(),
            'topic_id' => $topic_id,
            'user_id' => rand(1, 10),
        ];
    }
}