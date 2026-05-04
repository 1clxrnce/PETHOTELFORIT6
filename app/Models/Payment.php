<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'Payments';
    protected $primaryKey = 'paymentID';
    public $timestamps = false;

    protected $fillable = [
        'bookingID',
        'paymentDate',
        'amount',
        'paymentMethod',
        'paymentStatus',
    ];

    protected $casts = [
        'paymentDate' => 'date',
        'amount' => 'decimal:2',
    ];

    // Relationships
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'bookingID', 'bookingID');
    }

    // Helper methods for partial payments
    public static function getTotalPaidForBooking($bookingID)
    {
        return self::where('bookingID', $bookingID)->sum('amount');
    }

    public static function getRemainingBalanceForBooking($bookingID)
    {
        $booking = \App\Models\Booking::find($bookingID);
        if (!$booking) return 0;
        
        $totalPaid = self::getTotalPaidForBooking($bookingID);
        return max(0, $booking->totalAmount - $totalPaid);
    }

    public static function getPaymentProgressForBooking($bookingID)
    {
        $booking = \App\Models\Booking::find($bookingID);
        if (!$booking || $booking->totalAmount == 0) return 0;
        
        $totalPaid = self::getTotalPaidForBooking($bookingID);
        return min(100, ($totalPaid / $booking->totalAmount) * 100);
    }

    public static function isFullyPaidForBooking($bookingID)
    {
        return self::getRemainingBalanceForBooking($bookingID) <= 0;
    }
}
