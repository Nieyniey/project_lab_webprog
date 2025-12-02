<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'gender',
        'password',
        'role',
    ];

    public function properties()
    {
        return $this->hasMany(Properties::class, 'UserID');
    }

    public function bookingheaders()
    {
        return $this->hasMany(BookingHeader::class, 'UserID');
    }

    public function favorites()
    {
        return $this->belongsToMany(Properties::class, 'favorites', 'UserID', 'PropertyID');
    }
}
