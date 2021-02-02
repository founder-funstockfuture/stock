<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Topic;
use Carbon\Carbon;


class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        Topic::factory()->count(200)->create(['published_at'=>Carbon::parse('-1 week')]);
    }
}