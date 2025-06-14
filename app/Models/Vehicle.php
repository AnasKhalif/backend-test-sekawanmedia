<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'type', 'ownership', 'plate_number'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
