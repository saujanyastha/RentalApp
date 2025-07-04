<?php

namespace App\Models;

// Make sure these are imported
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type_id', // Make sure 'type_id' is here
        'temporary_address',
        'permanent_address',
        'personal_contactphone_number',
        'business_contactphone_number',
        'altextra_phone_number',
        'google_map_location',
        'facebook_link',
        'tiktok_link',
        'instagram_link',
        'note',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Define the relationship to UserType
    public function userType()
    {
        return $this->belongsTo(UserType::class, 'type_id');
    }

    // Define the relationship to Vehicles (a user can own many vehicles)
    public function ownedVehicles()
    {
        return $this->hasMany(Vehicle::class, 'owner_id');
    }

    // Define the relationship to Rentals (a user can be a renter for many rentals)
    public function rentalsAsRenter()
    {
        return $this->hasMany(Rental::class, 'renter_id');
    }

    // Define polymorphic relationship for Images (if you want users to have images)
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}