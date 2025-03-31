<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Form1Answer;

class Form1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Form1Answer::create([
            'kode_fasyankes' => '10270103',
            'village_name' => 'Dahlia',
            'year' => '2025',
            'q1' => 't',
            'q2' => 'y',
            'q3a' => '3',
            'q3b' => '290',
            'q4a' => '3',
            'q4b' => '210',
            'q5a' => '3',
            'q5b' => '296',
            'q6a' => '1',
            'q6b' => '80',
        ]);
        
        Form1Answer::create([
            'kode_fasyankes' => '10270103',
            'village_name' => 'Mawar',
            'year' => '2025',
            'q1' => 'y',
            'q2' => 'y',
            'q3a' => '4',
            'q3b' => '280',
            'q4a' => '4',
            'q4b' => '260',
            'q5a' => '4',
            'q5b' => '300',
            'q6a' => '1',
            'q6b' => '90',
        ]);

        Form1Answer::create([
            'kode_fasyankes' => '10270103',
            'village_name' => 'Melati',
            'year' => '2025',
            'q1' => 't',
            'q2' => 'y',
            'q3a' => '4',
            'q3b' => '260',
            'q4a' => '4',
            'q4b' => '250',
            'q5a' => '4',
            'q5b' => '290',
            'q6a' => '1',
            'q6b' => '85',
        ]);
    }
}
