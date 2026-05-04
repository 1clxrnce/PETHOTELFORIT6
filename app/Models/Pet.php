<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $table = 'Pets';
    protected $primaryKey = 'petID';
    public $timestamps = false;

    protected $fillable = [
        'cusID',
        'petName',
        'petPhoto',
        'petType',
        'breed',
        'gender',
        'birthdate',
        'weightSize',
        'vaccinationFile',
    ];

    protected $casts = [
        'birthdate' => 'date',
    ];

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cusID', 'cusID');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'petID', 'petID');
    }
}
