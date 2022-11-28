<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;
    protected $table = 'coupons';
    protected $primaryKey = 'coupon_id';
    protected $fillable = [
        'coupon_name',
        'coupon_code',
        'coupon_times',
        'coupon_condition',
        'coupon_number'
    ];
}
