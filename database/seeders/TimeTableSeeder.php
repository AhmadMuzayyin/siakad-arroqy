<?php

namespace Database\Seeders;

use App\Models\TimeTable;
use Illuminate\Database\Seeder;

class TimeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TimeTable::factory()
            ->count(5)
            ->create();
    }
}
