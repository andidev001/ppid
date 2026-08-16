<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin PPID',
            'email' => 'admin@ppid.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Atasan PPID',
            'email' => 'atasan@ppid.com',
            'password' => Hash::make('password'),
            'role' => 'supervisor',
        ]);
        
        User::create([
            'name' => 'Johon Doe (Pemohon)',
            'email' => 'user@ppid.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
