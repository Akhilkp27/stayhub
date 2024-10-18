<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Staff::create([
            'first_name' => 'John',
            'last_name' => 'Wick',
            'email' => 'staff@stayhub.com',
            'phone' => '1234567890',
            'role' => 2, 
            'username' => 'johndoe',
            'password' => Hash::make('staff123'),
            'address' => '123 Main Street, City, Country',
            'start_date' => '2023-01-01',
            'salary' => 50000.00,
            'status' => 'active',
            'image_url' => '',
        ]);
    }
}
