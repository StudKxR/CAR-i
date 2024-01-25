<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'service_centre';
    
    protected $fillable = [
        'name',
        'email',
        'phone',
        'location',
        'user_id',
    ];


    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'service_centre_id');
    }
}
