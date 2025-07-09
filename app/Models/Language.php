<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    /** @use HasFactory<\Database\Factories\LanugageFactory> */
    use HasFactory;
    protected $fillable = ['name', 'code', 'flag', 'direction', 'status'];
        protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function stores()
    {
        return $this->hasMany(Store::class, );
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function coupons()
    {
        return $this->hasMany(Coupon::class, );
    }
    public function blogs()
    {
        return $this->hasMany(Blog::class, );
    }
    public function sliders()
    {
        return $this->hasMany(Slider::class, );
    }

}
