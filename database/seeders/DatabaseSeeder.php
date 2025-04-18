<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use database\seeders\ProvinceSeeder;
// use database\seeders\RegencySeeder;
// use database\seeders\FasyankesSeeder;
// use database\seeders\UserSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            ProvinceSeeder::class,
            RegencySeeder::class,
            FasyankesSeeder::class,
            UserSeeder::class,
            SkdrSeeder::class,
            Form1Seeder::class,
            Form2Seeder::class,
            Form3Seeder::class,
            VaccineSeeder::class,
        ]);

    }
}
