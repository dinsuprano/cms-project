<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create Employer User
        User::create([
            'name' => 'Employer Demo',
            'email' => 'employer@test.com',
            'password' => Hash::make('employer123'),
            'role' => 'employer',
        ]);

        // Create Job Seeker User
        User::create([
            'name' => 'Job Seeker Demo',
            'email' => 'jobseeker@test.com',
            'password' => Hash::make('jobseeker123'),
            'role' => 'user',
        ]);
    }
}

