<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    /** @use HasFactory<\Database\Factories\CouponFactory> */
    use HasFactory;
        /** @use HasFactory<\Database\Factories\CouponFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'clicks',
        'order',
        'description',
        'code',
        'top_coupons',
        'ending_date',
        'status',
        'authentication',
        'user_id',
        'store_id',
        'updated_id',

    ];

    protected $casts = [
        'ending_date' => 'datetime',
    ];
    public function store()
    {
        return $this->belongsTo(Store::class,);
    }
     public function language()
    {
        return $this->belongsTo(language::class,);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
     public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_id');
    }


}
