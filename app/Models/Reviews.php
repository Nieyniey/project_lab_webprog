<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $table = 'reviews';

    protected $casts = [
        'ReviewDate' => 'datetime',
    ];

    protected $fillable = [
        'BookingID',
        'Rating',
        'Comment',
        'ReviewDate',
    ];

    public function bookingheader()
    {
        return $this->belongsTo(BookingHeader::class, 'BookingID');
    }
}
