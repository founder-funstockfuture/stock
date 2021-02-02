<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('description');
            $table->string('image');
            $table->boolean('on_sale')->default(true)->comment('商品是否在販售');
            $table->float('rating')->default(5)->comment('商品評價平均分數');
            $table->unsignedInteger('sold_count')->default(0)->comment('商品銷量');
            $table->unsignedInteger('review_count')->default(0)->comment('商品評價次數');
            $table->decimal('price', 10, 0)->comment('取 SKU 最低價格');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
