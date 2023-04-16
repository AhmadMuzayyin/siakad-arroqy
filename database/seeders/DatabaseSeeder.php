<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(HomeroomTeacherSeeder::class);
        $this->call(LessonSeeder::class);
        $this->call(RaportSeeder::class);
        $this->call(ScoreSeeder::class);
        $this->call(SemesterSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(StudentClassSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(TimeTableSeeder::class);
        $this->call(UserSeeder::class);
    }
}
