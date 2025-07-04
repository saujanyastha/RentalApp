<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    protected $fillable = ['type_name', 'description'];

    // If you have a 'users' table and want to relate, you could add:
    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }
}