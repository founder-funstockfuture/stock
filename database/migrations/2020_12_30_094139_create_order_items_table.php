<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('product_sku_id');
            $table->foreign('product_sku_id')->references('id')->on('product_skus')->onDelete('cascade');
            $table->unsignedInteger('amount');
            $table->decimal('price', 10, 0)->comment('單價');
            $table->unsignedInteger('rating')->nullable()->comment('用戶打分');
            $table->text('review')->nullable()->comment('用戶評語');
            $table->timestamp('reviewed_at')->nullable()->comment('用戶評語時間');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
