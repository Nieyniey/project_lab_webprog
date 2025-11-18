<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BookingDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bookingdetails')->insert([
            [
            'BookingID' => 1,
            'PropertyID' => 1,
            'GuestCount' => 2,
            'PricePerNight' => 500000
            ],
            [
            'BookingID' => 2,
            'PropertyID' => 2,
            'GuestCount' => 4,
            'PricePerNight' => 1200000
            ],
        ]);
    }
}
