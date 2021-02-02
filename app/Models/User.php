<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Auth;
use Spatie\Permission\Traits\HasRoles;
use Encore\Admin\Traits\DefaultDatetimeFormat;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use Traits\HashIdHelper;
    use Traits\LastActivedAtHelper;
    use HasRoles;
    use HasFactory, Notifiable, MustVerifyEmailTrait;
    use Notifiable {
        notify as protected laravelNotify;
    }
    // 調整預設日期顯示格式
    use DefaultDatetimeFormat;

    
    public function notify($instance)
    {
        // 如果要通知的人是當前用戶，就不必通知了！
        if ($this->id == Auth::id()) {
            return;
        }

        // 只有數據庫類型通知才需提醒，直接發送 Email 或者其他的都 Pass
        if (method_exists($instance, 'toDatabase')) {
            $this->increment('notification_count');
        }

        $this->laravelNotify($instance);
    }


    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'provider_id',
        'email_verified_at',
        'introduction',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    public function favoriteProducts()
    {
        return $this->belongsToMany(Product::class, 'user_favorite_products')
            ->withTimestamps()
            ->orderBy('user_favorite_products.created_at', 'desc');
    }

    public function favoriteTopics()
    {
        return $this->belongsToMany(Topics::class, 'user_favorite_topics')
            ->withTimestamps()
            ->orderBy('user_favorite_topics.created_at', 'desc');
    }

    public function subscribeTopics()
    {
        return $this->belongsToMany(Topics::class, 'user_subscribe_topics')
            ->withTimestamps()
            ->orderBy('user_subscribe_topics.created_at', 'desc');
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    
    // 判斷使用者是否是擁有此筆資料者
    public function isAuthorOf($model)
    {
        return $this->id == $model->user_id;
    }

    // 清零已讀計數
    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }


}