<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;


class CloseOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order, $delay)
    {
        $this->order = $order;
        // 設置延遲的時間，多少秒之後執行
        $this->delay($delay);
    }

    // 定義這個任務類具體的執行邏輯
    // 當隊列處理器從隊列中取出任務時，會調用 handle() 方法
    public function handle()
    {
        // 判斷對應的訂單是否已經被支付
        // 如果已經支付則不需要關閉訂單，直接退出
        if ($this->order->paid_at) {
            return;
        }
        // 通過事務執行 sql
        \DB::transaction(function() {
            // 將訂單的 closed 字段標記爲 true，即關閉訂單
            $this->order->update(['closed' => true]);
            // 循環遍歷訂單中的商品 SKU，將訂單中的數量加回到 SKU 的庫存中去
            foreach ($this->order->items as $item) {
                $item->productSku->addStock($item->amount);
            }
        });
    }

    
}
