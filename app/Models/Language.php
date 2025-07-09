<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    /** @use HasFactory<\Database\Factories\LanugageFactory> */
    use HasFactory;
    protected $fillable = ['name', 'code', 'flag', 'direction', 'status'];

}
