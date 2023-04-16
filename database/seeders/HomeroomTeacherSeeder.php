<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeroomTeacher;

class HomeroomTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomeroomTeacher::factory()
            ->count(5)
            ->create();
    }
}
