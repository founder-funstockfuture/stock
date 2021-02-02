<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;


class Order extends Model
{
    use HasFactory;

    const REFUND_STATUS_PENDING = 'pending';
    const REFUND_STATUS_APPLIED = 'applied';
    const REFUND_STATUS_PROCESSING = 'processing';
    const REFUND_STATUS_SUCCESS = 'success';
    const REFUND_STATUS_FAILED = 'failed';

    const SHIP_STATUS_PENDING = 'pending';
    const SHIP_STATUS_DELIVERED = 'delivered';
    const SHIP_STATUS_RECEIVED = 'received';

    public static $refundStatusMap = [
        self::REFUND_STATUS_PENDING    => '未退款',
        self::REFUND_STATUS_APPLIED    => '已申請退款',
        self::REFUND_STATUS_PROCESSING => '退款中',
        self::REFUND_STATUS_SUCCESS    => '退款成功',
        self::REFUND_STATUS_FAILED     => '退款失敗',
    ];

    public static $shipStatusMap = [
        self::SHIP_STATUS_PENDING   => '未發貨',
        self::SHIP_STATUS_DELIVERED => '已發貨',
        self::SHIP_STATUS_RECEIVED  => '已收貨',
    ];

	// 付款方式
    const PAY_TYPE_ONLINE = 'ecpay';

    
    protected $fillable = [
        'no',
        'address',
        'total_amount',
        'remark',
        'paid_at',
        'payment_method',
        'payment_no',
        'refund_status',
        'refund_no',
        'closed',
        'reviewed',
        'ship_status',
        'ship_data',
        'extra',
    ];

    protected $casts = [
        'closed'    => 'boolean',
        'reviewed'  => 'boolean',
        'address'   => 'json',
        'ship_data' => 'json',
        'extra'     => 'json',
    ];

    protected $dates = [
        'paid_at',
    ];

    protected static function boot()
    {
        parent::boot();
        // 監聽模型建立事件，在寫入資料庫之前觸發
        static::creating(function ($model) {
            // 如果模型的 no 欄位為空
            if (!$model->no) {
                // 呼叫 findAvailableNo 生成訂單流水號
                $model->no = static::findAvailableNo();
                // 如果生成失敗，則終止建立訂單
                if (!$model->no) {
                    return false;
                }
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function findAvailableNo()
    {
        // 訂單流水號字首
        $prefix = date('ymdHis');
        for ($i = 0; $i < 10; $i++) {
            // 隨機生成 4 位的數字
            $no = $prefix.str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
            // 判斷是否已經存在
            if (!static::query()->where('no', $no)->exists()) {
                return $no;
            }
        }
        \Log::warning('find order no failed');

        return false;
    }

    public static function getAvailableRefundNo()
    {
        do {
            // Uuid類可以用來生成大概率不重複的字元串
            $no = Uuid::uuid4()->getHex();
            // 為了避免重複我們在生成之後在資料庫中查詢看看是否已經存在相同的退款訂單號
        } while (self::query()->where('refund_no', $no)->exists());

        return $no;
    }

}
