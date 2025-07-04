<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'method_name',
        'description',
    ];

    // If a Payment Method can have many Payments
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}