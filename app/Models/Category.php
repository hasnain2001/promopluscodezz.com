<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
          protected $fillable = [
        'user_id',
        'updated_id',
        'language_id',
        'name',
        'slug',
        'top_category',
        'status',
        'image',
        'title',
        'meta_keyword',
        'meta_description',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_id');
    }

    public function stores() : HasMany
    {
        return $this->hasMany(store::class,);
    }
    public function blogs() : HasMany
    {
        return $this->hasMany(Blog::class);
    }
    public function language()
    {
        return $this->belongsTo(language::class);
    }
}
