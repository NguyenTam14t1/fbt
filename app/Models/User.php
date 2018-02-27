<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'description',
        'avatar',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function bookings()
    {
        $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        $this->hasMany(Review::class);
    }

    public function likes()
    {
        $this->hasMany(Like::class);
    }

    public function bankAccounts()
    {
        $this->hasMany(BankAccount::class);
    }
}
