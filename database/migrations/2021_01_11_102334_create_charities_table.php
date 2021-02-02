<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharitiesTable extends Migration
{
    public function up()
    {
        Schema::create('charities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('love_name')->comment('慈善機構名稱');
            $table->string('love_code')->comment('慈善機構代碼');
            $table->boolean('enabled')->default(0)->comment('是否開啟');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('charities');
    }
}
