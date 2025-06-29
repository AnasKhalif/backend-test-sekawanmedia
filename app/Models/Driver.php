<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'license_number',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
