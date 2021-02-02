<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsSeeder extends Seeder
{
    public function run()
    {
        // 創建 50 個Tag
        $tags = Tag::factory()->count(50)->create();
    }
}
