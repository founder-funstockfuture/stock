<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Requests\SendReviewRequest;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\ProductSku;
use App\Models\UserAddress;
use App\Models\Order;
use App\Jobs\CloseOrder;
use DB;
use App\Events\OrderReviewed;

class OrdersController extends Controller
{
    public function store(OrderRequest $request)
    {
        $user  = $request->user();
        // 開啟一個資料庫事務
        $order = \DB::transaction(function () use ($user, $request) {

            if($address = UserAddress::find($request->input('address_id'))){
                // 更新此地址的最後使用時間
                $address->update(['last_used_at' => Carbon::now()]);
            }

            // 建立一個訂單
            $order = new Order([
                'payment_method' => 'ecpay',
                'remark' => $request->input('remark'),
                'total_amount' => 0,
            ]);

            if($address){
                $order->address =[ 
                    'address' => $address->full_address,
                    'zip' => $address->zip,
                    'contact_name' => $address->contact_name,
                    'contact_phone' => $address->contact_phone,
                ];
            }

            // 訂單關聯到當前使用者
            $order->user()->associate($user);
            // 寫入資料庫
            $order->save();

            $totalAmount = 0;
            $items = $request->input('items');
            // 遍歷使用者提交的 SKU
            foreach ($items as $data) {
                $sku  = ProductSku::find($data['sku_id']);
                // 建立一個 OrderItem 並直接與當前訂單關聯
                $item = $order->items()->make([
                    'amount' => $data['amount'],
                    'price' => $sku->price,
                ]);
                $item->product()->associate($sku->product_id);
                $item->productSku()->associate($sku);
                $item->save();
                $totalAmount += $sku->price * $data['amount'];

                /*
                // 減庫存後，判斷是否商品數量足夠
                if ($sku->decreaseStock($data['amount']) <= 0) {
                    throw new InvalidRequestException('該商品庫存不足');
                }
                */

            }

            // 更新訂單總金額
            $order->update(['total_amount' => $totalAmount]);

            // 將下單的商品從購物車中移除
            $skuIds = collect($items)->pluck('sku_id');
            $user->cartItems()->whereIn('product_sku_id', $skuIds)->delete();

            // 關閉訂單(為了庫存)
            //$this->dispatch(new CloseOrder($order, config('app.order_ttl')));


            return $order;
        });

        return $order;
    }

    public function index(Request $request)
    {
        $orders = Order::query()
            // 使用 with 方法預載入，避免N + 1問題
            ->with(['items.product', 'items.productSku'])
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate();

        return view('orders.index', ['orders' => $orders]);
    }
    
    public function show(Order $order, Request $request)
    {
        $this->authorize('own', $order);
        
        return view('orders.show', ['order' => $order->load(['items.productSku', 'items.product'])]);
    }


    public function review(Order $order)
    {
        $this->authorize('own', $order);

        // 判斷是否已經支付
        if (!$order->paid_at) {
            throw new InvalidRequestException('該訂單未支付，不可評價');
        }

        return view('orders.review', ['order' => $order->load(['items.productSku', 'items.product'])]);
    }

    public function sendReview(Order $order, SendReviewRequest $request)
    {
        // 校驗許可權
        $this->authorize('own', $order);
        if (!$order->paid_at) {
            throw new InvalidRequestException('該訂單未支付，不可評價');
        }
        // 判斷是否已經評價
        if ($order->reviewed) {
            throw new InvalidRequestException('該訂單已評價，不可重複提交');
        }
        $reviews = $request->input('reviews');
        // 開啟事務
        \DB::transaction(function () use ($reviews, $order) {
            // 遍歷使用者提交的資料
            foreach ($reviews as $review) {
                $orderItem = $order->items()->find($review['id']);
                // 儲存評分和評價
                $orderItem->update([
                    'rating'      => $review['rating'],
                    'review'      => $review['review'],
                    'reviewed_at' => Carbon::now(),
                ]);
            }
            // 將訂單標記為已評價
            $order->update(['reviewed' => true]);
        });    

        event(new OrderReviewed($order));

        return redirect()->back();
    }



}
