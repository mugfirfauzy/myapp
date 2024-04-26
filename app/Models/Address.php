<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'province_id',
        'city_id',
        'district_id',
        'postal_code',
        'user_id',
        'is_default',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function province() {
        return $this->belongsTo(RoProvince::class);
    }

    public function city() {
        return $this->belongsTo(RoCity::class);
    }

    public function district() {
        return $this->belongsTo(RoDistrict::class);
    }
}
