<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingHeader extends Model
{
    protected $table = 'bookingheader';
    protected $primaryKey = 'BookingID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'BookingID',
        'UserID',
        'PropertyID',
        'BookingDate',
        'CheckInDate',
        'CheckOutDate',
        'TotalPrice',
        'BookingStatus',
        'ReviewStatus',
    ];

    public function property()
    {
        return $this->belongsTo(Properties::class, 'PropertyID', 'PropertyID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }
}
