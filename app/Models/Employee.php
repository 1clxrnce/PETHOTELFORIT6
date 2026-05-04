<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'Employees';
    protected $primaryKey = 'empID';
    public $timestamps = false;

    protected $fillable = [
        'userID',
        'empFName',
        'empMName',
        'empLName',
        'phoneNum',
        'email',
        'birthdate',
        'gender',
        'address',
        'hireDate',
    ];

    protected $casts = [
        'birthdate' => 'date',
        'hireDate' => 'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'empID', 'empID');
    }
}
