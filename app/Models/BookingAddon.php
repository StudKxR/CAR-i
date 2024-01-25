<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingAddon extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id','rental_car_id','selected_addon_id',
    ];

    public function addons()
    {
        return $this->belongsTo(Addons::class, 'selected_addon_id');
    }
}
