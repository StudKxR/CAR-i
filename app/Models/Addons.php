<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addons extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        // Add other columns as needed
    ];

    public function rentalCar()
    {
        return $this->belongsTo(RentalCar::class, 'car_id');
    }
}
