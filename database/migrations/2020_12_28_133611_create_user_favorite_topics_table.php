<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFavoriteTopicsTable extends Migration
{
    public function up()
    {
        Schema::create('user_favorite_topics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('topic_id');
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['user_id', 'topic_id']);

        });
    }

    public function down()
    {
        Schema::dropIfExists('user_favorite_topics');
    }
}
