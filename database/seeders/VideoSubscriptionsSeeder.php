<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VideoSubscription;
use Carbon\Carbon;


class VideoSubscriptionsSeeder extends Seeder
{
    public function run()
    {
        VideoSubscription::factory()->count(5)->create();
    }
}