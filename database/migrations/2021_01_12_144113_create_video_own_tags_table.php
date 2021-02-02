<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoOwnTagsTable extends Migration
{
    public function up()
    {
        Schema::create('video_own_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('video_id');
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->string('tag_name')->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('video_own_tags');
    }
}
