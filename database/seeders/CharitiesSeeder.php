<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Charity;

class CharitiesSeeder extends Seeder
{
    public function run()
    {
        // 創建 30 個
        $charities = Charity::factory()->count(10)->create();
    }
}
