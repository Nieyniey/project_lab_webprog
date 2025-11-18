<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('propertycategories')->insert([
            ['PropertyCategoryName' => 'Apartment'],
            ['PropertyCategoryName' => 'Villa'],
            ['PropertyCategoryName' => 'Guest House'],
            ['PropertyCategoryName' => 'Homestay'],
            ['PropertyCategoryName' => 'Studio'],
            ['PropertyCategoryName' => 'Cottage'],
            ]);
    }
}
