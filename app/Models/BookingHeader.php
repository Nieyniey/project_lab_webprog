<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingHeader extends Model
{
    protected $table = 'bookingheader';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'UserID',
        'BookingDate',
        'CheckInDate',
        'CheckOutDate',
        'TotalPrice'
    ];

    public function details()
    {
        return $this->hasMany(BookingDetail::class, 'BookingID', 'id');
    }

    public function property()
    {
        return $this->hasOneThrough(
            Properties::class,  
            BookingDetail::class,
            'BookingID',
            'id',
            'id',
            'PropertyID'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'id');
    }
}
