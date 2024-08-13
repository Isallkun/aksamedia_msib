<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'id' => (string) \Illuminate\Support\Str::uuid(),
            'name' => 'Admin Name',
            'username' => 'admin',
            'phone' => '1234567890',
            'email' => 'admin@example.com',
            'password' => Hash::make('pastibisa'),
        ]);
    }
}
