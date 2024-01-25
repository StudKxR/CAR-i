<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id','rental_car_id','selected_package_id',
    ];


    public function packages()
    {
        return $this->belongsTo(Package::class, 'selected_package_id');
    }
}
