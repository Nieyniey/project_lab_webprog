<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['Name' => 'Layla',
            'Email' => 'admin@airins.com',
            'Phone' => '081111111111',
            'Gender' => 'Female',
            'Password' => Hash::make('admin123'),
            'Role' => 'admin'],
            ['Name' => 'Hanif',
            'Email' => 'hanif@mail.com',
            'Phone' => '082222222222',
            'Gender' => 'Male',
            'Password' => Hash::make('member123'),
            'Role' => 'member'],
            ['Name' => 'Bagus',
            'Email' => 'bagus@mail.com',
            'Phone' => '083333333333',
            'Gender' => 'Male',
            'Password' => Hash::make('member123'),
            'Role' => 'member'],
        ]);
    }
}
