<?php

namespace App\Listeners;

use DB;
use App\Models\OrderItem;
use App\Events\OrderReviewed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateProductRating implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(OrderReviewed $event)
    {
        // 通過 with 方法提前載入資料，避免 N + 1 效能問題
        $items = $event->getOrder()->items()->with(['product'])->get();
        foreach ($items as $item) {
            $result = OrderItem::query()
                ->where('product_id', $item->product_id)
                ->whereNotNull('reviewed_at')
                ->whereHas('order', function ($query) {
                    $query->whereNotNull('paid_at');
                })
                ->first([
                    DB::raw('count(*) as review_count'),
                    DB::raw('avg(rating) as rating')
                ]);
            // 更新商品的評分和評價數
            $item->product->update([
                'rating'       => $result->rating,
                'review_count' => $result->review_count,
            ]);
        }
    }
}
