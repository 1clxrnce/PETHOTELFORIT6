<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'Customers';
    protected $primaryKey = 'cusID';
    public $timestamps = false;

    protected $fillable = [
        'userID',
        'cusFName',
        'cusMName',
        'cusLName',
        'phoneNum',
        'email',
        'address',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    public function pets()
    {
        return $this->hasMany(Pet::class, 'cusID', 'cusID');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'cusID', 'cusID');
    }
}
