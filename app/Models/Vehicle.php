<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = ['model', 'brand', 'year', 'power'];

    public function user(){
        return $this->belongsTo('App\Model\User');
    }
}
