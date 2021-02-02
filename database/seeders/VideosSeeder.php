<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video;
use Carbon\Carbon;


class VideosSeeder extends Seeder
{
    public function run()
    {
        Video::factory()->count(100)->create(['published_at'=>Carbon::parse('-1 week')]);
    }
}