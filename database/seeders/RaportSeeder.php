<?php

namespace Database\Seeders;

use App\Models\Raport;
use Illuminate\Database\Seeder;

class RaportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Raport::factory()
            ->count(5)
            ->create();
    }
}
