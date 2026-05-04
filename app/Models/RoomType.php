<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $table = 'RoomTypes';
    protected $primaryKey = 'roomTypeID';
    public $timestamps = false;

    protected $fillable = [
        'typeName',
        'description',
        'pricePerNight',
        'maxCapacity',
    ];

    protected $casts = [
        'pricePerNight' => 'decimal:2',
        'maxCapacity' => 'integer',
    ];

    // Relationships
    public function rooms()
    {
        return $this->hasMany(Room::class, 'roomTypeID', 'roomTypeID');
    }
}
