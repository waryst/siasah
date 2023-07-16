<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Warist Amru Khoruddin',
            'datasekolah_id' =>'0',
            'email' => 'admin1',
            'role'=>'administrator',
            'password'=>Hash::make('admin'),
        ]);
    }
}
