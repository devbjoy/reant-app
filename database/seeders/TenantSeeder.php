<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // You can seed the tenants table with initial data here.
        // For example, you might want to create a default tenant.
        \App\Models\Tenant::create([
            'first_name' => 'Bijoy',
            'last_name' => 'Saha',
            'email' => 'bijoy@gmail.com',
            'password' => bcrypt('password'), // Use bcrypt for password hashing
            'phone' => '01610008240',
            'pin_number' => 1234,
        ]);
    }
}
