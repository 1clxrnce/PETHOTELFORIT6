<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddOn extends Model
{
    use HasFactory;

    protected $table = 'AddOns';
    protected $primaryKey = 'addOnID';
    public $timestamps = false;

    protected $fillable = [
        'addOnName',
        'price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    // Relationships
    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'BookingAddOns', 'addOnID', 'bookingID')
                    ->withPivot('quantity');
    }
}
