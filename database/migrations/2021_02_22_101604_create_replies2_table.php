<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplies2Table extends Migration 
{
	public function up()
	{
		Schema::create('replies2', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('reply_id')->unsigned()->default(0)->index();
            $table->bigInteger('user_id')->unsigned()->default(0)->index();
            $table->text('content');
			$table->timestamps();
			$table->softDeletes();
        });
	}

	public function down()
	{
		Schema::drop('replies2');
	}
}
