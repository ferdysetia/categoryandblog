<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Karyawan; // Tambahkan model Karyawan
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat 10 data dummy untuk User (opsional)
        User::factory(10)->create();

        // Buat 10 data dummy untuk Karyawan
        Karyawan::factory(100)->create();

        // Contoh jika ingin menambahkan karyawan dengan data spesifik
        Karyawan::factory()->create([
            'firstname' => 'Budi',
            'lastname' => 'Santoso',
            'age' => 30,
        ]);
    }
}
