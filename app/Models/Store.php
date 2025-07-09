<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    /** @use HasFactory<\Database\Factories\StoreFactory> */
    use HasFactory;

        protected $fillable = [
        'user_id',
        'category_id',
        'updated_id',
        'network_id',
        'name',
        'url',
        'destination_url',
        'top_store',
        'description',
        'about',
        'slug',
        'top_category',
        'status',
        'image',
        'title',
        'meta_keyword',
        'meta_description',
        'created_at',
        'updated_at',
        'deleted_at',
        'content',


    ];
    protected $dates = [
    'updated_at',
    'created_at',
    // any other date fields
];
    protected $casts = [
    'updated_at' => 'datetime',
    'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function coupons()
    {
        return $this->hasMany(Coupon::class, 'store_id');
    }
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
     public function network()
    {
        return $this->belongsTo(Network::class, 'network_id');
    }
}
