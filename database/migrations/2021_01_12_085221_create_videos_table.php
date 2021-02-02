<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->index();
            $table->string('youtube_url')->comment('youtube影片連結');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('category_id')->unsigned()->index();
            $table->integer('reply_count')->unsigned()->default(0);
            $table->integer('view_count')->unsigned()->default(0);
            $table->integer('pay_count')->unsigned()->default(0)->comment('購買次數');
            $table->integer('last_reply_user_id')->unsigned()->default(0);
            $table->integer('order')->unsigned()->default(0)->comment('排序使用');
            $table->text('excerpt')->nullable()->comment('摘要');
            $table->boolean('on_sale')->default(false)->comment('商品是否需付費');
            $table->integer('coin')->unsigned()->default(0)->comment('付費金額');
            $table->boolean('is_show')->default(true)->comment('是否上架');
            $table->boolean('is_blocked')->default(false)->comment('管理者封鎖');
            $table->timestamp('published_at')->nullable()->comment('發佈時間');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
