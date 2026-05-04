<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'Rooms';
    protected $primaryKey = 'roomID';
    public $timestamps = false;

    protected $fillable = [
        'roomTypeID',
        'roomNum',
        'roomPhoto',
        'status',
    ];

    // Relationships
    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'roomTypeID', 'roomTypeID');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'roomID', 'roomID');
    }

    // Get current occupancy (number of pets currently in the room)
    public function getCurrentOccupancy()
    {
        return $this->bookings()
            ->whereIn('status', ['Confirmed', 'Pending'])
            ->whereDate('checkInDate', '<=', now())
            ->whereDate('checkOutDate', '>=', now())
            ->count();
    }

    // Get available spots
    public function getAvailableSpots()
    {
        $maxCapacity = $this->roomType->maxCapacity ?? 0;
        $currentOccupancy = $this->getCurrentOccupancy();
        return max(0, $maxCapacity - $currentOccupancy);
    }

    // Check if room is fully occupied
    public function isFullyOccupied()
    {
        return $this->getAvailableSpots() === 0;
    }

    // Get occupancy status
    public function getOccupancyStatus()
    {
        $current = $this->getCurrentOccupancy();
        $max = $this->roomType->maxCapacity ?? 0;

        if ($current === 0) {
            return 'Available';
        } elseif ($current >= $max) {
            return 'Full';
        } else {
            return 'Partially Occupied';
        }
    }
}
