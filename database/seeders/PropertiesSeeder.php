<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('properties')->insert([
            [
            'UserID' => 2,
            'CategoryID' => 1,
            'Title' => 'Luxury Apartment in Jakarta',
            'Description' => 'A cozy apartment perfect for business trips.',
            'Photos' => 'apartment1.jpg',
            'Location' => 'Jakarta',
            'Price' => 500000,
            'IsAvailable' => 1,
            ],
            [
            'UserID' => 2,
            'CategoryID' => 2,
            'Title' => 'Bali Villa with Private Pool',
            'Description' => 'A beautiful villa located near Bali beach.',
            'Photos' => 'villa1.jpg',
            'Location' => 'Bali',
            'Price' => 1200000,
            'IsAvailable' => 1,
            ],
            [
            'UserID' => 3,
            'CategoryID' => 3,
            'Title' => 'Cozy Guest House in Bandung',
            'Description' => 'Affordable guest house near city center.',
            'Photos' => 'guest1.jpg',
            'Location' => 'Bandung',
            'Price' => 300000,
            'IsAvailable' => 1,
            ],
            [
            'UserID' => 2,
            'CategoryID' => 4,
            'Title' => 'Modern Homestay Surabaya',
            'Description' => 'Comfortable homestay for family trips.',
            'Photos' => 'home1.jpg',
            'Location' => 'Surabaya',
            'Price' => 400000,
            'IsAvailable' => 1,
            ],
        ]);
    }
}
