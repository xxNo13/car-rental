<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_brand',
        'car_model',
        'plate_number'
    ];

    public function car_images() {
        return $this->hasMany(CarImages::class);
    }
}
