<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFavoriteVideosTable extends Migration
{
    public function up()
    {
        Schema::create('user_favorite_videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('video_id');
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['user_id', 'video_id']);

        });
    }

    public function down()
    {
        Schema::dropIfExists('user_favorite_videos');
    }
}
