<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'Name' => 'Grace',
            'email' => 'grace@airins.com',
            'phone' => '0864312468',
            'gender' => 'Female',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}

