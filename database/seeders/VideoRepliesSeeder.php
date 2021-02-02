<?php

namespace  Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VideoReply;

class VideoRepliesSeeder extends Seeder
{
    public function run()
    {
        VideoReply::factory()->times(200)->create();
    }
}