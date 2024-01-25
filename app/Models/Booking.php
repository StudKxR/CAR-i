<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id','car_id',
        'first_name','last_name','age',
        'location','phone', 
        'pickup_date', 'pickup_time', 
        'dropoff_date', 'dropoff_time',
        'status','review',
        'images','tracking',
        'latitude','longitude',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cars()
    {
        return $this->belongsTo(RentalCar::class, 'car_id');
    }


    public function bookingPackages()
    {
        return $this->hasMany(BookingPackage::class);
    }

    public function bookingAddons()
    {
        return $this->hasMany(BookingAddon::class);
    }
}

