<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (App::environment('production')) {
            Log::warning('AdminUserSeeder: Skipping in production environment.');
            return;
        }

        $adminEmail = 'graphics@smartbrainskenya.com';
        $adminPassword = env('ADMIN_PASSWORD');

        if (empty($adminPassword)) {
            Log::warning('AdminUserSeeder: ADMIN_PASSWORD environment variable not set. Skipping admin user creation.');
            $this->command->warn('ADMIN_PASSWORD environment variable not set. Skipping admin user creation.');
            return;
        }

        User::updateOrCreate(
            ['email' => $adminEmail],
            [
                'name' => 'Admin',
                'password' => Hash::make($adminPassword),
                'email_verified_at' => now(),
            ]
        );

        $this->command->info("Admin user '{$adminEmail}' provisioned successfully.");
    }
}
