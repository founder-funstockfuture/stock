<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;

trait LastActivedAtHelper
{
    // 緩存相關
    protected $hash_prefix = 'stock_last_actived_at_';
    protected $field_prefix = 'user_';

    // 記錄最後存取頁面時間
    public function recordLastActivedAt()
    {
        // 獲取今天的日期
        $date = Carbon::now()->toDateString();

        // Redis 哈希表的命名，如：stock_last_actived_at_2020-10-21
        $hash = $this->hash_prefix . $date;

        // 字段名稱，如：user_1
        $field = $this->field_prefix . $this->id;

        // 當前時間，如：2017-10-21 08:35:15
        $now = Carbon::now()->toDateTimeString();

        // 數據寫入 Redis ，字段已存在會被更新
        Redis::hSet($hash, $field, $now);
    }

    // 每日將昨天的 redis 資料存入資料庫
    public function syncUserActivedAt()
    {
        // 獲取昨天的日期，格式如：2020-10-21
        $yesterday_date = Carbon::yesterday()->toDateString();

        // Redis 哈希表的命名，如：stock_last_actived_at_2017-10-21
        $hash = $this->hash_prefix . $yesterday_date;

        // 從 Redis 中獲取所有哈希表裏的數據
        $dates = Redis::hGetAll($hash);

        // 遍歷，並同步到數據庫中
        foreach ($dates as $user_id => $actived_at) {
            // 會將 `user_1` 轉換爲 1
            $user_id = str_replace($this->field_prefix, '', $user_id);

            // 只有當用戶存在時才更新到數據庫中
            if ($user = $this->find($user_id)) {
                $user->last_actived_at = $actived_at;
                $user->save();
            }
        }

        // 已同步，即可刪除
        Redis::del($hash);
    }

    // 取最後存取時間 last_actived_at
    public function getLastActivedAtAttribute()
    {
        // 獲取今天的日期
        $date = Carbon::now()->toDateString();

        // Redis 哈希表的命名，如：stock_last_actived_at_2020-10-21
        $hash = $this->hash_prefix . $date;

        // 字段名稱，如：user_1
        $field = $this->field_prefix . $this->id;

        // 三元運算符，優先選擇 Redis 的數據，否則使用數據庫中
        $datetime = Redis::hGet($hash, $field);

        // 如果存在的話，返回時間對應的 Carbon 實體
        if ($datetime) {
            return new Carbon($datetime);
        } else {
        // 否則使用用戶註冊時間
            return $this->created_at;
        }
    }

}