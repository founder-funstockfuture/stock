<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no')->unique()->comment('訂單流水號');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('address')->nullable();
            $table->decimal('total_amount', 10, 0);
            $table->text('remark')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->string('payment_method')->nullable()->comment('支付方式');
            $table->string('payment_no')->nullable()->comment('支付平台訂單');
            $table->string('refund_status')->default(\App\Models\Order::REFUND_STATUS_PENDING)->comment('退款狀態');
            $table->string('refund_no')->unique()->nullable()->comment('退款單號');
            $table->boolean('closed')->default(false)->comment('訂單是否關閉');
            $table->boolean('reviewed')->default(false)->comment('訂單是否評價');
            $table->string('ship_status')->default(\App\Models\Order::SHIP_STATUS_PENDING)->comment('物流狀態');
            $table->text('ship_data')->nullable()->comment('物流資料');
            $table->text('extra')->nullable()->comment('其它額外資料');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
