<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
            // 從資料庫隨機取一條商品
            $product = Product::query()->where('on_sale', true)->inRandomOrder()->first();
            // 從該商品的 SKU 中隨機取一條
            $sku = $product->skus()->inRandomOrder()->first();
        
            return [
                'amount'         => random_int(1, 5), // 購買數量隨機 1 - 5 份
                'price'          => $sku->price,
                'rating'         => null,
                'review'         => null,
                'reviewed_at'    => null,
                'product_id'     => $product->id,
                'product_sku_id' => $sku->id,
            ];
    }
}
