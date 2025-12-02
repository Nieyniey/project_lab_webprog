<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bookingheader')->insert([
            [
            'UserID' => 2,
            'BookingDate' => now(),
            'CheckInDate' => now()->addDays(2),
            'CheckOutDate' => now()->addDays(5),
            'TotalPrice' => 1500000,
            // 'BookingStatus' => 'completed',
            // 'ReviewStatus' => 'not_reviewed'
            ],
            [
            'UserID' => 3,
            'BookingDate' => now()->subDays(10),
            'CheckInDate' => now()->subDays(8),
            'CheckOutDate' => now()->subDays(5),
            'TotalPrice' => 3600000
            // 'BookingStatus' => 'completed',
            // 'ReviewStatus' => 'not_reviewed'
            ],
        ]);
    }
}
