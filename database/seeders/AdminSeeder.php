<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin 68Hosting',
            'email' => 'admin@68hosting.zone.id',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Assign admin role
        $admin->assignRole('admin');

        $this->command->info('✅ Admin user created successfully!');
        $this->command->info('📧 Email: admin@68hosting.zone.id');
        $this->command->info('🔐 Password: password');
    }
}
