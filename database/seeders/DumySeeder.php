<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DumySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $class = ['1 MADIN', '2 MADIN', '3 MADIN', '4 MADIN', '5 MADIN', '6 MADIN'];
        foreach ($class as $val) {
            \App\Models\StudentClass::create([
                'name' => $val
            ]);
        }
        $teacher = ['Zubaidi Mukhtar', 'Hanif Suruji', "Ma'sumah", 'Nur Fadila', 'Muawanah', 'Layyinah', 'Niani', 'Rasyidah', 'Tin Mafrudhah', 'Khorriyah', 'Khotijah', 'Moh. Nazzal', 'Qudsi Yanto', 'Musleh'];
        foreach ($teacher as $value) {
            \App\Models\Teacher::create([
                'name' => $value,
                'phone' => fake()->phoneNumber(),
                'gender' => fake()->randomElement(['male', 'female']),
                'address' => fake()->address()
            ]);
        }
    }
}
