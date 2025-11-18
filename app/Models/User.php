<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
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
