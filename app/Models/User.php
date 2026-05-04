<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'Users';
    protected $primaryKey = 'userID';
    public $timestamps = false; // Your database doesn't have created_at/updated_at

    protected $fillable = [
        'username',
        'password',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function customer()
    {
        return $this->hasOne(Customer::class, 'userID', 'userID');
    }

    public function employee()
    {
        return $this->hasOne(Employee::class, 'userID', 'userID');
    }
}
