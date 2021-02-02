<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'province',
        'city',
        'district',
        'address',
        'zip',
        'contact_name',
        'contact_phone',
        'last_used_at',
    ];
	
	//轉換為日期格式
    protected $dates = ['last_used_at'];
    protected $appends = ['full_address'];
	
    public function user()
    {
        return $this->belongsTo(User::class);
    }

	//通過 $address->full_address 來獲取完整的地址
    public function getFullAddressAttribute()
    {
        return "{$this->province}{$this->city}{$this->district}{$this->address}";
    }

}
