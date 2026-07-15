<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'image', 
        'weekday_day_price', 'weekday_night_price', 'weekend_price', 'is_active'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
