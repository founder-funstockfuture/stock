<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'price', 'stock'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }



    // 減庫存
    public function decreaseStock($amount)
    {
        if ($amount < 0) {
            throw new InternalException('減庫存不可小於0');
        }

        return $this->where('id', $this->id)->where('stock', '>=', $amount)->decrement('stock', $amount);
    }

    // 增庫存
    public function addStock($amount)
    {
        if ($amount < 0) {
            throw new InternalException('加庫存不可小於0');
        }
        $this->increment('stock', $amount);
    }


}
