<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalCar extends Model
{
    use HasFactory;
    public $table = 'car';
    
    protected $fillable = [
        'user_id','name',
        'plate','category',
        'mode','seats',
        'pickup','latitude','longitude',
        'aircond','luggage','addons',
        'rental_price',
        'status','mileage',
        'last_maintenance',
        'images',
    ];
    protected $casts = [
        'addons' => 'json',
    ];




    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    public function bookings()
    {
        return $this->hasMany(Booking::class, 'car_id');
    }

    

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class, 'car_id');
    }


    
    public function packages()
    {
        return $this->hasMany(Package::class, 'car_id');
    }

    public function addOns()
    {
        return $this->hasMany(Addons::class, 'car_id');
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
