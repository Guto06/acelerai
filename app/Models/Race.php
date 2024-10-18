<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category', 'max_vehicles', 'date'];

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class)
                    ->withPivot('position', 'time') // Adiciona os campos da tabela intermediária
                    ->withTimestamps();
    }
}
