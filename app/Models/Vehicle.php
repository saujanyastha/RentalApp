<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'owner_id',
        'name',
        'brand',
        'color',
        'make_year',
        'lot_no',
        'engine_no',
        'vehicle_no',
        'type_id',
        'chassis_no',
        'status',
        'purchased_price',
        'purchased_date',
        'note',
        'tax_renewal_date',
        'insurance_renewal_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'purchased_date' => 'date',
        'tax_renewal_date' => 'date',
        'insurance_renewal_date' => 'date',
    ];

    // Define the relationship to User (owner)
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Define the relationship to VehicleType
    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'type_id');
    }

    // Define the relationship to Rentals (a vehicle can have many rentals)
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    // Define polymorphic relationship for Images (if you want vehicles to have images)
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}