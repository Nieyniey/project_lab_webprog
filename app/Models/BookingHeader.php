<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingHeader extends Model
{
    protected $table = 'bookingheader';

     public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function bookingdetails()
    {
        return $this->hasMany(BookingDetail::class, 'BookingID');
    }

    public function review()
    {
        return $this->hasOne(Reviews::class, 'BookingID');
    }
}
