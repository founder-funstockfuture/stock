<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TopicSubscription;
use Carbon\Carbon;


class TopicSubscriptionsSeeder extends Seeder
{
    public function run()
    {
        TopicSubscription::factory()->count(5)->create();
    }
}