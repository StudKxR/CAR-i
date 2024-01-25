<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'description',
        'service_date',
        'mileage',
        'service_centre_id',
        'maintenance_needed',   
        'status',
    ];

    public function cars()
    {
        return $this->belongsTo(RentalCar::class, 'car_id');
    }

    public function serviceProvider()
    {
        return $this->belongsTo(Service::class, 'service_centre_id');
    }
    
}
