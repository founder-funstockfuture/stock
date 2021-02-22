<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TopicsTableSeeder::class);
        $this->call(RepliesTableSeeder::class);
        $this->call(Replies2TableSeeder::class);
        $this->call(ProductsSeeder::class);
        //$this->call(CouponCodesSeeder::class);
        $this->call(OrdersSeeder::class);
        $this->call(CharitiesSeeder::class);
        $this->call(TagsSeeder::class);
        $this->call(VideosSeeder::class);
        $this->call(VideoRepliesSeeder::class);
        $this->call(TopicSubscriptionsSeeder::class);
        $this->call(VideoSubscriptionsSeeder::class);
        
    }
}
