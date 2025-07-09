<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeleteRequest extends Model
{

     use HasFactory;
    protected $fillable = [
        'store_id',
        'user_id',
        'status',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class,'store_id');
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
