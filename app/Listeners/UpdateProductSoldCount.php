<?php

namespace App\Listeners;

use App\Events\OrderPaid;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\OrderItem;


class UpdateProductSoldCount
{
    // Laravel 會默認執行監聽器的 handle 方法，觸發的事件會作爲 handle 方法的參數
    public function handle(OrderPaid $event)
    {
        // 從事件對象中取出對應的訂單
        $order = $event->getOrder();
        // 預加載商品數據
        $order->load('items.product');
        // 循環遍歷訂單的商品
        foreach ($order->items as $item) {
            $product   = $item->product;
            // 計算對應商品的銷量
            $soldCount = OrderItem::query()
                ->where('product_id', $product->id)
                ->whereHas('order', function ($query) {
                    $query->whereNotNull('paid_at');  // 關聯的訂單狀態是已支付
                })->sum('amount');
            // 更新商品銷量
            $product->update([
                'sold_count' => $soldCount,
            ]);
        }
    }
}
