<?php

namespace App\Listeners;

use App\Events\OrderPaid;
use App\Notifications\OrderPaidNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

// implements ShouldQueue 代表非同步監聽器
class SendOrderPaidMail implements ShouldQueue
{
    public function handle(OrderPaid $event)
    {
        // 從事件物件中取出對應的訂單
        $order = $event->getOrder();
        // 呼叫 notify 方法來傳送通知
        $order->user->notify(new OrderPaidNotification($order));
    }
}
