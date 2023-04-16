<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::create([
            'name' => 'Admin Siakad',
            'email' => 'admin@arroqy.ac.id',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'remember_token' => str()->random(10)
        ]);
        $this->call(PermissionsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DumySeeder::class);

        // $this->call(StudentClassSeeder::class);
        // $this->call(HomeroomTeacherSeeder::class);
        // $this->call(LessonSeeder::class);
        // $this->call(RaportSeeder::class);
        // $this->call(ScoreSeeder::class);
        // $this->call(SemesterSeeder::class);
        // $this->call(StudentSeeder::class);
        // $this->call(TeacherSeeder::class);
        // $this->call(TimeTableSeeder::class);
    }
}
