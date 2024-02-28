<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'car_id',
        'fuel_description',
        'mileage_policy',
        'included_protection',
        'add_price',
        'cancellation_policy',
    ];

    public function rentalCar()
    {
        return $this->belongsTo(RentalCar::class, 'car_id');
    }

}
