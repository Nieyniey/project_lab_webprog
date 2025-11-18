<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        // 1. BOOKING HEADER
        DB::table('bookingheader')->insert([
            [
                'UserID'       => 2,
                'BookingDate'  => now(),
                'CheckInDate'  => now()->addDays(2),
                'CheckOutDate' => now()->addDays(5),
                'TotalPrice'   => 1500000
            ],
            [
                'UserID'       => 3,
                'BookingDate'  => now()->subDays(10),
                'CheckInDate'  => now()->subDays(8),
                'CheckOutDate' => now()->subDays(5),
                'TotalPrice'   => 3600000
            ],
        ]);

        // 2. BOOKING DETAIL
        DB::table('bookingdetail')->insert([
            [
                'BookingID'     => 1,
                'PropertyID'    => 1,
                'GuestCount'    => 2,
                'PricePerNight' => 500000
            ],
            [
                'BookingID'     => 2,
                'PropertyID'    => 2,
                'GuestCount'    => 4,
                'PricePerNight' => 1200000
            ],
        ]);
    }
}
