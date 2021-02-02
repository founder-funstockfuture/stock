<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedVideoCategoriesData extends Migration
{
    public function up()
    {
        $categories = [
            [
                'name'        => '功能教學',
                'description' => '分享創造，分享發現',
            ],
            [
                'name'        => '飆股搜尋教學應用',
                'description' => '開發技巧、推薦擴展包等',
            ],
            [
                'name'        => '百寶箱',
                'description' => '請保持友善，互幫互助',
            ],
            [
                'name'        => 'KD 指標',
                'description' => '站點公告',
            ],
        ];

        DB::table('video_categories')->insert($categories);
    }

    public function down()
    {
        DB::table('video_categories')->truncate();
    }
}