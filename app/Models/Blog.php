<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /** @use HasFactory<\Database\Factories\BlogFactory> */
    use HasFactory;
      protected $fillable = [
        'user_id',
        'title',
        'slug',
        'category_id',
        'content',
        'image',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'status',
        'language_id',
        'store_id',
        'updated_id',
    ];
    protected $casts = [
        'status' => 'boolean',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_id');
    }
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
     public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
