<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoritesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('favorites')->insert([
            ['UserID' => 2, 'PropertyID' => 1],
            ['UserID' => 2, 'PropertyID' => 2],
            ['UserID' => 3, 'PropertyID' => 3],
        ]);
    }
}
