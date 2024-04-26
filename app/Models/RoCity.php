<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoCity extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'city',
        'type',
        'postal_code'
    ];

}
