<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaceVehicle extends Model
{
    use HasFactory;

    protected $table = 'race_vehicle';
    protected $fillable = [
        'race_id',
        'vehicle_id',
        'position',
        'time',
        'fuel_consumption',
        'average_speed',
        'car_condition',
        'points',
    ];

    // Relacionamento com Race
    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    // Relacionamento com Vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
