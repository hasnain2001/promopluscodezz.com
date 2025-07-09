<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckInOut extends Model
{
    protected $fillable = [
        'user_id',
        'check_in_at',
        'check_out_at',
    ];
    protected $casts = [
        'check_in_at' => 'datetime',
        'check_out_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
