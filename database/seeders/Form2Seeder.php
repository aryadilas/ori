<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Form2Answer;
use App\Enums\Form2ImunizedReason;
use App\Enums\ImunizedInformationSource;

class Form2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Form2Answer::create([
            'house_id' => '1',
            'kode_fasyankes' => '10270103',
            'year' => '2025',
            'parent_name' => 'Ayat',
            'child_name' => 'Eka',
            'birthdate' => '2021-02-12 00:00:00',
            'gender' => 'p',
            'q1' => 'y',
            'q2' => 'y',
            'q3' => 't',
            'q4' => 't',
            'q5' => Form2ImunizedReason::OP4,
            'q6' => 'y',
            'q7' => ImunizedInformationSource::OP3,
            'q8' => 't',
            'q9' => null,
        ]);
        Form2Answer::create([
            'house_id' => '1',
            'kode_fasyankes' => '10270103',
            'year' => '2025',
            'parent_name' => 'Ayat',
            'child_name' => 'Yani',
            'birthdate' => '2022-10-17 00:00:00',
            'gender' => 'p',
            'q1' => 't',
            'q2' => 'y',
            'q3' => 't',
            'q4' => 'y',
            'q5' => Form2ImunizedReason::OP13,
            'q6' => 'y',
            'q7' => ImunizedInformationSource::OP2,
            'q8' => 't',
            'q9' => null,
        ]);
        Form2Answer::create([
            'house_id' => '1',
            'kode_fasyankes' => '10270103',
            'year' => '2025',
            'parent_name' => 'Ayat',
            'child_name' => 'Uli',
            'birthdate' => '2022-01-09 00:00:00',
            'gender' => 'l',
            'q1' => 'y',
            'q2' => 'y',
            'q3' => 'y',
            'q4' => 'y',
            'q5' => Form2ImunizedReason::OP8,
            'q6' => 'y',
            'q7' => ImunizedInformationSource::OP9,
            'q8' => 't',
            'q9' => null,
        ]);
        Form2Answer::create([
            'house_id' => '1',
            'kode_fasyankes' => '10270103',
            'year' => '2025',
            'parent_name' => 'Budi',
            'child_name' => 'Dedi',
            'birthdate' => '2023-07-06 00:00:00',
            'gender' => 'l',
            'q1' => 't',
            'q2' => 'y',
            'q3' => 't',
            'q4' => 'y',
            'q5' => null,
            'q6' => 'y',
            'q7' => ImunizedInformationSource::OP3,
            'q8' => 't',
            'q9' => null,
        ]);
        Form2Answer::create([
            'house_id' => '1',
            'kode_fasyankes' => '10270103',
            'year' => '2025',
            'parent_name' => 'Budi',
            'child_name' => 'Joko',
            'birthdate' => '2018-02-21 00:00:00',
            'gender' => 'l',
            'q1' => 't',
            'q2' => 'y',
            'q3' => 't',
            'q4' => 't',
            'q5' => null,
            'q6' => 'y',
            'q7' => ImunizedInformationSource::OP3,
            'q8' => 't',
            'q9' => null,
        ]);
        Form2Answer::create([
            'house_id' => '1',
            'kode_fasyankes' => '10270103',
            'year' => '2025',
            'parent_name' => 'Budi',
            'child_name' => 'Hari',
            'birthdate' => '2020-09-23 00:00:00',
            'gender' => 'l',
            'q1' => 'y',
            'q2' => 't',
            'q3' => 'y',
            'q4' => 't',
            'q5' => null,
            'q6' => 'y',
            'q7' => ImunizedInformationSource::OP4,
            'q8' => 't',
            'q9' => null,
        ]);
        

    }
}
