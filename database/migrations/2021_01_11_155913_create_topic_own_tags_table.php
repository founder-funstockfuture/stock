<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicOwnTagsTable extends Migration
{
    public function up()
    {
        Schema::create('topic_own_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('topic_id');
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->string('tag_name')->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('topic_own_tags');
    }
}
