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
        // Create admin user if not exists
        $admin = User::firstOrCreate(
            ['email' => 'admin@68hosting.zone.id'],
            [
                'name' => 'Admin 68Hosting',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('✅ Admin user created successfully!');
        $this->command->info('📧 Email: admin@68hosting.zone.id');
        $this->command->info('🔐 Password: password');
    }
}
