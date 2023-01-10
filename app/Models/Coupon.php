<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'coupons';
    protected $appends = ['type'];
    protected $fillable = [
        'coupon_name',
        'coupon_code',
        'coupon_times',
        'coupon_condition',
        'coupon_number',
        'start_time',
        'end_time',
        'coupon_status'
    ];

    const TYPE = [
        'PERCENT' => 1,
        'MONEY' => 2
    ];

    const TypeArr = [
        [
            'key' => self::TYPE['PERCENT'],
            'name' => 'Giảm theo phần trăm'
        ],
        [
            'key' => self::TYPE['MONEY'],
            'name' => 'Giảm theo tiền mặt'
        ]
    ];

    const STATUS = [
        'ACTIVE' => 0,
        'NONACTIVE' => 1
    ];

    
    const STATUS_UNLOCKED = 1;
    const STATUS_LOCKED = 0;

    protected $statusArr = [
        self::STATUS_UNLOCKED => 'Mã giảm giá đang hoạt động',
        self::STATUS_LOCKED => 'Mã đã bị khoá',
    ];

    public function getTypeAttribute()
    {
        if($this->coupon_condition == self::TYPE['PERCENT']){
            $type = 'Giảm theo phần trăm';
        } else{
            $type = 'Giảm theo tiền mặt';
        }
        return $type;
    }

    public function getStatusTextAttribute()
    {
        return $this->statusArr [$this->status];
    }
}
