<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('topic_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index()->comment('名稱');
            $table->text('description')->nullable()->comment('描述');
            $table->integer('post_count')->default(0)->comment('文章數');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('topic_categories');
    }
}