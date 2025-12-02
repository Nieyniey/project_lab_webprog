<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    protected $table = 'bookingdetail';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'BookingID',
        'PropertyID',
        'GuestCount',
        'PricePerNight'
    ];

    public function property()
    {
        return $this->belongsTo(Properties::class, 'PropertyID', 'id');
    }
}
