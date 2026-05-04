<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingAddOn extends Model
{
    use HasFactory;

    protected $table = 'BookingAddOns';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'bookingID',
        'addOnID',
        'quantity',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    // Relationships
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'bookingID', 'bookingID');
    }

    public function addOn()
    {
        return $this->belongsTo(AddOn::class, 'addOnID', 'addOnID');
    }
}
