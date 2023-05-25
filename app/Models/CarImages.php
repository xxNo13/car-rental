<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_url',
        'car_id',
    ];

    public function car() {
        return $this->belongsTo(Car::class);
    }
}
