<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'vehicle_id',
        'renter_id',
        'rental_start_date',
        'rental_end_date',
        'payment_start_date',
        'daily_amount',
        'advance',
        'advance_amount',
        'status',
        'estimated_rent_end_date',
        'note',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'rental_start_date' => 'date',
        'rental_end_date' => 'date',
        'payment_start_date' => 'date',
        'estimated_rent_end_date' => 'date',
        'advance' => 'boolean', // Cast 'advance' to a boolean
    ];


    // Define the relationship to Vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    // Define the relationship to User (renter)
    public function renter()
    {
        return $this->belongsTo(User::class, 'renter_id');
    }

    // Define the relationship to Payments
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Define the relationship to RentalAdjustments
    public function adjustments()
    {
        return $this->hasMany(RentalAdjustment::class);
    }
}