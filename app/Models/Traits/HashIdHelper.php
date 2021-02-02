<?php

namespace App\Models\Traits;

use Hashids;

trait HashIdHelper
{
    private $hashId;

    // 調用 $model->hash_id 時觸發
    public function getHashIdAttribute()
    {
        if (!$this->hashId) {
            $this->hashId = Hashids::encode($this->id);
        }

        return $this->hashId;
    }

    // 先將參數 decode 爲模型id，再調用父類的 resolveRouteBinding 方法
    public function resolveRouteBinding($value, $field = null)
    {
        $value = current(Hashids::decode($value));
        if (!$value) {
            return;
        }
        return parent::resolveRouteBinding($value, $field = null);
    }


    // 使用 hash_id 生成 URL
    public function getRouteKey()
    {
        return $this->hash_id;
    }
}