<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Form3Answer;

class Form3Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Form3Answer::create([
            'kode_fasyankes' => '10270103',
            'year' => '2025',
            'age_group' => '9 - <18 bulan',
            'suspect' => '96',
            'population' => '1663',
        ]);
        Form3Answer::create([
            'kode_fasyankes' => '10270103',
            'year' => '2025',
            'age_group' => '18 - 59 bulan',
            'suspect' => '64',
            'population' => '13648',
        ]);
        Form3Answer::create([
            'kode_fasyankes' => '10270103',
            'year' => '2025',
            'age_group' => '5 - <7 tahun',
            'suspect' => '29',
            'population' => '8016',
        ]);
        Form3Answer::create([
            'kode_fasyankes' => '10270103',
            'year' => '2025',
            'age_group' => '7 - <13tahun',
            'suspect' => '20',
            'population' => '29074',
        ]);
        Form3Answer::create([
            'kode_fasyankes' => '10270103',
            'year' => '2025',
            'age_group' => '13 - <16 tahun',
            'suspect' => '5',
            'population' => '15601',
        ]);
        Form3Answer::create([
            'kode_fasyankes' => '10270103',
            'year' => '2025',
            'age_group' => '≥ 16 tahun',
            'suspect' => '0',
            'population' => '181711',
        ]);
    }
}
