<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Network extends Model
{
    /** @use HasFactory<\Database\Factories\NetworkFactory> */
    use HasFactory;
        protected $fillable = [
        'title',
        'user_id',
        'updated_id'
    ];
    /**
     * Get the user that owns the Network
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function user()
    {
    return $this->belongsTo(User::class,'user_id');
    }
    public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_id');
    }
    public function stores(): HasMany
    {
        return $this->hasMany(Store::class);
    }
}
