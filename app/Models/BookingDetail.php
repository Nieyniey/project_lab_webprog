<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    protected $table = 'bookingdetail';
    public function bookingheader()
    {
        return $this->belongsTo(BookingHeader::class, 'BookingID');
    }

    public function property()
    {
        return $this->belongsTo(Properties::class, 'PropertyID');
    }

}
