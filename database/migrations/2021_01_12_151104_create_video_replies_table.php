<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoRepliesTable extends Migration 
{
	public function up()
	{
		Schema::create('video_replies', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('video_id')->unsigned()->default(0)->index();
            $table->bigInteger('user_id')->unsigned()->default(0)->index();
            $table->text('content');
			$table->timestamps();
			$table->softDeletes();
        });
	}

	public function down()
	{
		Schema::drop('video_replies');
	}
}
