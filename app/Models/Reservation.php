<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'vehicle_id',
        'driver_id',
        'approver_level1_id',
        'approver_level2_id',
        'approval_level1_status',
        'approval_level2_status',
        'reservation_date',
        'purpose',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function approverLevel1()
    {
        return $this->belongsTo(User::class, 'approver_level1_id');
    }

    public function approverLevel2()
    {
        return $this->belongsTo(User::class, 'approver_level2_id');
    }
}
