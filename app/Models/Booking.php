<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'Bookings';
    protected $primaryKey = 'bookingID';
    public $timestamps = false;

    protected $fillable = [
        'cusID',
        'petID',
        'roomID',
        'empID',
        'checkInDate',
        'checkOutDate',
        'totalAmount',
        'status',
    ];

    protected $casts = [
        'checkInDate' => 'date',
        'checkOutDate' => 'date',
        'totalAmount' => 'decimal:2',
    ];

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cusID', 'cusID');
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'petID', 'petID');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'roomID', 'roomID');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'empID', 'empID');
    }

    public function addOns()
    {
        return $this->belongsToMany(AddOn::class, 'BookingAddOns', 'bookingID', 'addOnID')
                    ->withPivot('quantity');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'bookingID', 'bookingID');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'bookingID', 'bookingID');
    }

    // Payment helper methods
    public function getTotalPaid()
    {
        return $this->payments()->sum('amount');
    }

    public function getRemainingBalance()
    {
        return max(0, $this->totalAmount - $this->getTotalPaid());
    }

    public function getPaymentProgress()
    {
        if ($this->totalAmount == 0) return 0;
        return min(100, ($this->getTotalPaid() / $this->totalAmount) * 100);
    }

    public function isFullyPaid()
    {
        return $this->getRemainingBalance() <= 0;
    }
}
