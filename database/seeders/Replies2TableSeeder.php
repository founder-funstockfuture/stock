<?php

namespace  Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reply2;

class Replies2TableSeeder extends Seeder
{
    public function run()
    {
        Reply2::factory()->times(200)->create();
    }
}