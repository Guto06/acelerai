<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category', 'max_vehicles', 'date', 'start_latitude', 'start_longitude', 'end_latitude', 'end_longitude'];


    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class)
                    ->withPivot('position', 'time')
                    ->withTimestamps();
    }
}

