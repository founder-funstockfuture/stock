<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration 
{
	public function up()
	{
		Schema::create('topics', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->index();
            $table->text('body');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('category_id')->unsigned()->index();
            $table->integer('reply_count')->unsigned()->default(0);
            $table->integer('view_count')->unsigned()->default(0);
            $table->integer('pay_count')->unsigned()->default(0)->comment('購買次數');
            $table->integer('last_reply_user_id')->unsigned()->default(0);
            $table->integer('order')->unsigned()->default(0);
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
		Schema::drop('topics');
	}
}
