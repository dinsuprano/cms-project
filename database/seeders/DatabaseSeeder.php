<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Truncate tables with foreign key checks disabled
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('job_user_bookmarks')->truncate();
            DB::table('applicants')->truncate();
            DB::table('job_listings')->truncate();
            DB::table('users')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            
            $this->call(AdminUserSeeder::class); // Seed admin and test users
            $this->call(TestUserSeeder::class); // Add this line
            $this->call(RandomUserSeeder::class);
            $this->call(JobSeeder::class);
    }
}
