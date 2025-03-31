<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skdr;

class SkdrSeeder extends Seeder
{
    /** 
     * Run the database seeds. 
     */
    public function run(): void
    {
        $formatPatientNames = function($names) {
            return array_map(function($name) {
                return ['name' => $name];
            }, $names);
        };
        
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 4,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Fadli']),
                'kode_fasyankes' => 10270103
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 11,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Dimas']),
                'kode_fasyankes' => 10270103
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 12,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270103
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 15,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Kelvin', 'Dimas']),
                'kode_fasyankes' => 10270103
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 16,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Kevin', 'Kelvin']),
                'kode_fasyankes' => 10270103
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 17,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kevin']),
                'kode_fasyankes' => 10270103
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 21,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Morgan']),
                'kode_fasyankes' => 10270103
            ]);
            
            Skdr::create([
                'officer_name' => 'Fitri',
                'week' => 22,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Fadli']),
                'kode_fasyankes' => 10270103
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 29,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Alya']),
                'kode_fasyankes' => 10270103
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 33,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Fadli']),
                'kode_fasyankes' => 10270103
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 36,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Alya']),
                'kode_fasyankes' => 10270103
            ]);
            
            Skdr::create([
                'officer_name' => 'Fitri',
                'week' => 39,
                'year' => 2025,
                'case_count' => 3,
                'patient_names' => $formatPatientNames(['Agung', 'Kevin', 'Lusi']),
                'kode_fasyankes' => 10270103
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 40,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kevin']),
                'kode_fasyankes' => 10270103
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 47,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Sari', 'Kevin']),
                'kode_fasyankes' => 10270103
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 17,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kelvin']),
                'kode_fasyankes' => 10270104
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 34,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Dimas']),
                'kode_fasyankes' => 10270104
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 51,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Morgan']),
                'kode_fasyankes' => 10270104
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 1,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Lusi']),
                'kode_fasyankes' => 10270105
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 7,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Sari']),
                'kode_fasyankes' => 10270105
            ]);
            
            Skdr::create([
                'officer_name' => 'Fitri',
                'week' => 4,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Fadli']),
                'kode_fasyankes' => 10270106
            ]);
            
            Skdr::create([
                'officer_name' => 'Agus',
                'week' => 18,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kelvin']),
                'kode_fasyankes' => 10270106
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 26,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Alya']),
                'kode_fasyankes' => 10270106
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 15,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Dimas']),
                'kode_fasyankes' => 10270107
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 18,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270107
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 19,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Alya']),
                'kode_fasyankes' => 10270107
            ]);
            
            Skdr::create([
                'officer_name' => 'Fitri',
                'week' => 35,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Agung', 'Dimas']),
                'kode_fasyankes' => 10270107
            ]);
            
            Skdr::create([
                'officer_name' => 'Siti',
                'week' => 1,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Kevin', 'Dimas']),
                'kode_fasyankes' => 10270108
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 10,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Alya']),
                'kode_fasyankes' => 10270108
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 13,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Fadli', 'Alya']),
                'kode_fasyankes' => 10270108
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 18,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Fadli', 'Andre']),
                'kode_fasyankes' => 10270108
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 19,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kelvin']),
                'kode_fasyankes' => 10270108
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 20,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Kevin', 'Lusi']),
                'kode_fasyankes' => 10270108
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 22,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Andre', 'Alya']),
                'kode_fasyankes' => 10270108
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 23,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kevin']),
                'kode_fasyankes' => 10270108
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 25,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Dimas']),
                'kode_fasyankes' => 10270108
            ]);
            
            Skdr::create([
                'officer_name' => 'Fitri',
                'week' => 29,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Morgan', 'Kelvin']),
                'kode_fasyankes' => 10270108
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 30,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Alya']),
                'kode_fasyankes' => 10270108
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 32,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Andre', 'Lusi']),
                'kode_fasyankes' => 10270108
            ]);
            
            Skdr::create([
                'officer_name' => 'Fitri',
                'week' => 36,
                'year' => 2025,
                'case_count' => 3,
                'patient_names' => $formatPatientNames(['Kelvin', 'Andre', 'Fadli']),
                'kode_fasyankes' => 10270108
            ]);
            
            Skdr::create([
                'officer_name' => 'Agus',
                'week' => 44,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Agung', 'Lusi']),
                'kode_fasyankes' => 10270108
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 47,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270108
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 50,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Sari']),
                'kode_fasyankes' => 10270108
            ]);
            
            Skdr::create([
                'officer_name' => 'Siti',
                'week' => 52,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kelvin']),
                'kode_fasyankes' => 10270108
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 1,
                'year' => 2025,
                'case_count' => 6,
                'patient_names' => $formatPatientNames(['Lusi', 'Sari', 'Dimas', 'Kelvin', 'Kevin', 'Andre']),
                'kode_fasyankes' => 10270109
            ]);
            
            Skdr::create([
                'officer_name' => 'Siti',
                'week' => 8,
                'year' => 2025,
                'case_count' => 3,
                'patient_names' => $formatPatientNames(['Kevin', 'Morgan', 'Agung']),
                'kode_fasyankes' => 10270109
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 9,
                'year' => 2025,
                'case_count' => 3,
                'patient_names' => $formatPatientNames(['Morgan', 'Fadli', 'Sari']),
                'kode_fasyankes' => 10270109
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 10,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Andre']),
                'kode_fasyankes' => 10270109
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 11,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Lusi']),
                'kode_fasyankes' => 10270109
            ]);
            
            Skdr::create([
                'officer_name' => 'Agus',
                'week' => 12,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270109
            ]);
            
            Skdr::create([
                'officer_name' => 'Fitri',
                'week' => 14,
                'year' => 2025,
                'case_count' => 6,
                'patient_names' => $formatPatientNames(['Andre', 'Sari', 'Dimas', 'Kevin', 'Morgan', 'Agung']),
                'kode_fasyankes' => 10270109
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 15,
                'year' => 2025,
                'case_count' => 6,
                'patient_names' => $formatPatientNames(['Alya', 'Fadli', 'Agung', 'Kevin', 'Morgan', 'Sari']),
                'kode_fasyankes' => 10270109
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 28,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Dimas']),
                'kode_fasyankes' => 10270109
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 39,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Sari']),
                'kode_fasyankes' => 10270109
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 40,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270109
            ]);
            
            Skdr::create([
                'officer_name' => 'Fitri',
                'week' => 43,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kevin']),
                'kode_fasyankes' => 10270109
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 44,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Kelvin', 'Agung']),
                'kode_fasyankes' => 10270109
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 45,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Dimas', 'Alya']),
                'kode_fasyankes' => 10270109
            ]);
            
            Skdr::create([
                'officer_name' => 'Agus',
                'week' => 50,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Lusi']),
                'kode_fasyankes' => 10270109
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 7,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Dimas']),
                'kode_fasyankes' => 10270110
            ]);
            
            Skdr::create([
                'officer_name' => 'Siti',
                'week' => 8,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270110
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 29,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270110
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 34,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Fadli']),
                'kode_fasyankes' => 10270110
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 9,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Sari']),
                'kode_fasyankes' => 10270111
            ]);
            
            Skdr::create([
                'officer_name' => 'Agus',
                'week' => 29,
                'year' => 2025,
                'case_count' => 3,
                'patient_names' => $formatPatientNames(['Fadli', 'Dimas', 'Alya']),
                'kode_fasyankes' => 10270111
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 30,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Sari']),
                'kode_fasyankes' => 10270111
            ]);
            
            Skdr::create([
                'officer_name' => 'Fitri',
                'week' => 51,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Dimas', 'Morgan']),
                'kode_fasyankes' => 10270111
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 10,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Lusi']),
                'kode_fasyankes' => 10270112
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 29,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Kevin', 'Lusi']),
                'kode_fasyankes' => 10270112
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 35,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Fadli', 'Alya']),
                'kode_fasyankes' => 10270112
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 40,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Alya']),
                'kode_fasyankes' => 10270112
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 10,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Fadli', 'Kelvin']),
                'kode_fasyankes' => 10270113
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 11,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Fadli']),
                'kode_fasyankes' => 10270113
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 12,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270113
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 14,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Morgan']),
                'kode_fasyankes' => 10270113
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 17,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270113
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 25,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Sari']),
                'kode_fasyankes' => 10270113
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 26,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Kevin', 'Kelvin']),
                'kode_fasyankes' => 10270113
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 35,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Lusi']),
                'kode_fasyankes' => 10270113
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 36,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270113
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 48,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Sari']),
                'kode_fasyankes' => 10270113
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 49,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Dimas']),
                'kode_fasyankes' => 10270113
            ]);
            
            Skdr::create([
                'officer_name' => 'Agus',
                'week' => 21,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Alya']),
                'kode_fasyankes' => 10270114
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 25,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Fadli']),
                'kode_fasyankes' => 10270114
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 39,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Sari']),
                'kode_fasyankes' => 10270114
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 10,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Dimas']),
                'kode_fasyankes' => 10270115
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 43,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Lusi']),
                'kode_fasyankes' => 10270115
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 49,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Andre']),
                'kode_fasyankes' => 10270115
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 11,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kevin']),
                'kode_fasyankes' => 10270116
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 24,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Fadli']),
                'kode_fasyankes' => 10270116
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 26,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Morgan']),
                'kode_fasyankes' => 10270116
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 28,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Morgan']),
                'kode_fasyankes' => 10270116
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 39,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Lusi']),
                'kode_fasyankes' => 10270116
            ]);
            
            Skdr::create([
                'officer_name' => 'Agus',
                'week' => 47,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270116
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 48,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270116
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 49,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Morgan']),
                'kode_fasyankes' => 10270116
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 4,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Dimas']),
                'kode_fasyankes' => 10270117
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 7,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Morgan']),
                'kode_fasyankes' => 10270117
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 7,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Dimas']),
                'kode_fasyankes' => 10270118
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 8,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Lusi']),
                'kode_fasyankes' => 10270118
            ]);
            
            Skdr::create([
                'officer_name' => 'Agus',
                'week' => 9,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kelvin']),
                'kode_fasyankes' => 10270118
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 14,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Fadli', 'Morgan']),
                'kode_fasyankes' => 10270118
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 17,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Dimas']),
                'kode_fasyankes' => 10270118
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 20,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Sari']),
                'kode_fasyankes' => 10270118
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 22,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Andre']),
                'kode_fasyankes' => 10270118
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 24,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Kelvin', 'Andre']),
                'kode_fasyankes' => 10270118
            ]);
            
            Skdr::create([
                'officer_name' => 'Siti',
                'week' => 27,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Kevin', 'Kelvin']),
                'kode_fasyankes' => 10270118
            ]);
            
            Skdr::create([
                'officer_name' => 'Agus',
                'week' => 28,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Andre', 'Morgan']),
                'kode_fasyankes' => 10270118
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 32,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kelvin']),
                'kode_fasyankes' => 10270118
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 40,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Kevin', 'Andre']),
                'kode_fasyankes' => 10270118
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 45,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Fadli']),
                'kode_fasyankes' => 10270118
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 52,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270118
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 31,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Alya']),
                'kode_fasyankes' => 10270119
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 45,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270119
            ]);
            
            Skdr::create([
                'officer_name' => 'Siti',
                'week' => 29,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Fadli']),
                'kode_fasyankes' => 10270120
            ]);
            
            Skdr::create([
                'officer_name' => 'Siti',
                'week' => 3,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Kevin', 'Fadli']),
                'kode_fasyankes' => 10270121
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 13,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Morgan', 'Agung']),
                'kode_fasyankes' => 10270121
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 18,
                'year' => 2025,
                'case_count' => 3,
                'patient_names' => $formatPatientNames(['Sari', 'Andre', 'Kelvin']),
                'kode_fasyankes' => 10270121
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 24,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Fadli']),
                'kode_fasyankes' => 10270121
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 30,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kelvin']),
                'kode_fasyankes' => 10270121
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 35,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Lusi']),
                'kode_fasyankes' => 10270121
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 36,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Dimas']),
                'kode_fasyankes' => 10270121
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 38,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270121
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 50,
                'year' => 2025,
                'case_count' => 3,
                'patient_names' => $formatPatientNames(['Fadli', 'Kevin', 'Sari']),
                'kode_fasyankes' => 10270121
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 51,
                'year' => 2025,
                'case_count' => 3,
                'patient_names' => $formatPatientNames(['Sari', 'Agung', 'Dimas']),
                'kode_fasyankes' => 10270121
            ]);
            
            Skdr::create([
                'officer_name' => 'Siti',
                'week' => 4,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Fadli', 'Lusi']),
                'kode_fasyankes' => 10270122
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 19,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270122
            ]);
            
            Skdr::create([
                'officer_name' => 'Agus',
                'week' => 21,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Sari']),
                'kode_fasyankes' => 10270122
            ]);
            
            Skdr::create([
                'officer_name' => 'Siti',
                'week' => 23,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Andre']),
                'kode_fasyankes' => 10270122
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 27,
                'year' => 2025,
                'case_count' => 3,
                'patient_names' => $formatPatientNames(['Morgan', 'Alya', 'Kelvin']),
                'kode_fasyankes' => 10270122
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 33,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Morgan']),
                'kode_fasyankes' => 10270122
            ]);
            
            Skdr::create([
                'officer_name' => 'Fitri',
                'week' => 34,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Kelvin', 'Agung']),
                'kode_fasyankes' => 10270122
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 37,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Dimas']),
                'kode_fasyankes' => 10270122
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 41,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Sari']),
                'kode_fasyankes' => 10270122
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 46,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Sari']),
                'kode_fasyankes' => 10270122
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 12,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Fadli', 'Dimas']),
                'kode_fasyankes' => 10270123
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 13,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Sari', 'Alya']),
                'kode_fasyankes' => 10270123
            ]);
            
            Skdr::create([
                'officer_name' => 'Siti',
                'week' => 14,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Lusi']),
                'kode_fasyankes' => 10270123
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 29,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270123
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 51,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kelvin']),
                'kode_fasyankes' => 10270123
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 3,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Andre']),
                'kode_fasyankes' => 10270124
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 24,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Lusi']),
                'kode_fasyankes' => 10270124
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 27,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kevin']),
                'kode_fasyankes' => 10270124
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 4,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kelvin']),
                'kode_fasyankes' => 10270125
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 18,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kelvin']),
                'kode_fasyankes' => 10270125
            ]);
            
            Skdr::create([
                'officer_name' => 'Fitri',
                'week' => 37,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kelvin']),
                'kode_fasyankes' => 10270125
            ]);
            
            Skdr::create([
                'officer_name' => 'Siti',
                'week' => 52,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kelvin']),
                'kode_fasyankes' => 10270125
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 15,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Andre']),
                'kode_fasyankes' => 10270126
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 17,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Dimas']),
                'kode_fasyankes' => 10270126
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 29,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Morgan']),
                'kode_fasyankes' => 10270126
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 2,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Fadli']),
                'kode_fasyankes' => 10270127
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 10,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270127
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 21,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Sari']),
                'kode_fasyankes' => 10270127
            ]);
            
            Skdr::create([
                'officer_name' => 'Fitri',
                'week' => 26,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kelvin']),
                'kode_fasyankes' => 10270127
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 29,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Alya']),
                'kode_fasyankes' => 10270127
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 33,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Fadli']),
                'kode_fasyankes' => 10270127
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 42,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Dimas']),
                'kode_fasyankes' => 10270127
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 52,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kevin']),
                'kode_fasyankes' => 10270127
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 34,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Morgan']),
                'kode_fasyankes' => 10270128
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 38,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Morgan', 'Fadli']),
                'kode_fasyankes' => 10270128
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 40,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kelvin']),
                'kode_fasyankes' => 10270128
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 3,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270129
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 4,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Morgan']),
                'kode_fasyankes' => 10270129
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 7,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Alya']),
                'kode_fasyankes' => 10270129
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 8,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Andre']),
                'kode_fasyankes' => 10270129
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 9,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Alya']),
                'kode_fasyankes' => 10270129
            ]);
            
            Skdr::create([
                'officer_name' => 'Fitri',
                'week' => 10,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Lusi']),
                'kode_fasyankes' => 10270129
            ]);
            
            Skdr::create([
                'officer_name' => 'Fitri',
                'week' => 17,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Andre']),
                'kode_fasyankes' => 10270129
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 23,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Morgan']),
                'kode_fasyankes' => 10270129
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 27,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Lusi']),
                'kode_fasyankes' => 10270129
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 29,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Sari']),
                'kode_fasyankes' => 10270129
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 38,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Alya']),
                'kode_fasyankes' => 10270129
            ]);
            
            Skdr::create([
                'officer_name' => 'Fitri',
                'week' => 39,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Sari']),
                'kode_fasyankes' => 10270129
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 48,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Sari']),
                'kode_fasyankes' => 10270129
            ]);
            
            Skdr::create([
                'officer_name' => 'Fitri',
                'week' => 2,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Dimas', 'Kelvin']),
                'kode_fasyankes' => 10270130
            ]);
            
            Skdr::create([
                'officer_name' => 'Siti',
                'week' => 3,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Fadli']),
                'kode_fasyankes' => 10270130
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 6,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Fadli']),
                'kode_fasyankes' => 10270130
            ]);
            
            Skdr::create([
                'officer_name' => 'Siti',
                'week' => 13,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Morgan']),
                'kode_fasyankes' => 10270130
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 17,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Alya']),
                'kode_fasyankes' => 10270130
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 34,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kevin']),
                'kode_fasyankes' => 10270130
            ]);
            
            Skdr::create([
                'officer_name' => 'Fitri',
                'week' => 36,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Lusi']),
                'kode_fasyankes' => 10270130
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 38,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Dimas']),
                'kode_fasyankes' => 10270130
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 42,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kevin']),
                'kode_fasyankes' => 10270130
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 43,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270130
            ]);
            
            Skdr::create([
                'officer_name' => 'Siti',
                'week' => 45,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Andre']),
                'kode_fasyankes' => 10270130
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 46,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Dimas']),
                'kode_fasyankes' => 10270130
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 7,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Morgan']),
                'kode_fasyankes' => 10270131
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 9,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Alya']),
                'kode_fasyankes' => 10270131
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 28,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270131
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 38,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270131
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 48,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Andre']),
                'kode_fasyankes' => 10270131
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 3,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Lusi', 'Kevin']),
                'kode_fasyankes' => 10270132
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 26,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kevin']),
                'kode_fasyankes' => 10270132
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 41,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Dimas', 'Andre']),
                'kode_fasyankes' => 10270132
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 52,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Fadli']),
                'kode_fasyankes' => 10270132
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 3,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kevin']),
                'kode_fasyankes' => 10270133
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 8,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kelvin']),
                'kode_fasyankes' => 10270133
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 9,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Sari']),
                'kode_fasyankes' => 10270133
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 11,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Sari', 'Fadli']),
                'kode_fasyankes' => 10270133
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 12,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Andre']),
                'kode_fasyankes' => 10270133
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 14,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Fadli']),
                'kode_fasyankes' => 10270133
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 16,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Lusi']),
                'kode_fasyankes' => 10270133
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 18,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Alya', 'Kelvin']),
                'kode_fasyankes' => 10270133
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 19,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Alya']),
                'kode_fasyankes' => 10270133
            ]);
            
            Skdr::create([
                'officer_name' => 'Siti',
                'week' => 20,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Morgan']),
                'kode_fasyankes' => 10270133
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 24,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Andre']),
                'kode_fasyankes' => 10270133
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 26,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Fadli']),
                'kode_fasyankes' => 10270133
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 29,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270133
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 30,
                'year' => 2025,
                'case_count' => 3,
                'patient_names' => $formatPatientNames(['Andre', 'Alya', 'Sari']),
                'kode_fasyankes' => 10270133
            ]);
            
            Skdr::create([
                'officer_name' => 'Agus',
                'week' => 39,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Sari', 'Kelvin']),
                'kode_fasyankes' => 10270133
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 45,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Kelvin', 'Kevin']),
                'kode_fasyankes' => 10270133
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 46,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Kevin', 'Kelvin']),
                'kode_fasyankes' => 10270133
            ]);
            
            Skdr::create([
                'officer_name' => 'Agus',
                'week' => 5,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kelvin']),
                'kode_fasyankes' => 10270134
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 13,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Sari']),
                'kode_fasyankes' => 10270134
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 19,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Dimas']),
                'kode_fasyankes' => 10270134
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 22,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Alya']),
                'kode_fasyankes' => 10270134
            ]);
            
            Skdr::create([
                'officer_name' => 'Siti',
                'week' => 23,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Dimas']),
                'kode_fasyankes' => 10270134
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 45,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kelvin']),
                'kode_fasyankes' => 10270134
            ]);
            
            Skdr::create([
                'officer_name' => 'Siti',
                'week' => 3,
                'year' => 2025,
                'case_count' => 3,
                'patient_names' => $formatPatientNames(['Morgan', 'Kevin', 'Fadli']),
                'kode_fasyankes' => 10270135
            ]);
            
            Skdr::create([
                'officer_name' => 'Siti',
                'week' => 10,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kevin']),
                'kode_fasyankes' => 10270135
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 11,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Lusi', 'Fadli']),
                'kode_fasyankes' => 10270135
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 13,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Lusi']),
                'kode_fasyankes' => 10270135
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 19,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kevin']),
                'kode_fasyankes' => 10270135
            ]);
            
            Skdr::create([
                'officer_name' => 'Fitri',
                'week' => 44,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Alya']),
                'kode_fasyankes' => 10270135
            ]);
            
            Skdr::create([
                'officer_name' => 'Siti',
                'week' => 47,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Dimas']),
                'kode_fasyankes' => 10270135
            ]);
            
            Skdr::create([
                'officer_name' => 'Agus',
                'week' => 50,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Kelvin', 'Alya']),
                'kode_fasyankes' => 10270135
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 10,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Morgan', 'Andre']),
                'kode_fasyankes' => 10270136
            ]);
            
            Skdr::create([
                'officer_name' => 'Budi',
                'week' => 12,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kevin']),
                'kode_fasyankes' => 10270136
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 29,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Fadli']),
                'kode_fasyankes' => 10270136
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 34,
                'year' => 2025,
                'case_count' => 2,
                'patient_names' => $formatPatientNames(['Andre', 'Dimas']),
                'kode_fasyankes' => 10270136
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 37,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Agung']),
                'kode_fasyankes' => 10270136
            ]);
            
            Skdr::create([
                'officer_name' => 'Ujang',
                'week' => 39,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Andre']),
                'kode_fasyankes' => 10270136
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 42,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Lusi']),
                'kode_fasyankes' => 10270136
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 43,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kelvin']),
                'kode_fasyankes' => 10270136
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 47,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Dimas']),
                'kode_fasyankes' => 10270136
            ]);
            
            Skdr::create([
                'officer_name' => 'Maya',
                'week' => 49,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Fadli']),
                'kode_fasyankes' => 10270136
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 52,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Andre']),
                'kode_fasyankes' => 10270136
            ]);
            
            Skdr::create([
                'officer_name' => 'Siti',
                'week' => 4,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Fadli']),
                'kode_fasyankes' => 10270137
            ]);
            
            Skdr::create([
                'officer_name' => 'Anton',
                'week' => 41,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Alya']),
                'kode_fasyankes' => 10270137
            ]);
            
            Skdr::create([
                'officer_name' => 'Agus',
                'week' => 13,
                'year' => 2025,
                'case_count' => 4,
                'patient_names' => $formatPatientNames(['Andre', 'Lusi', 'Kevin', 'Alya']),
                'kode_fasyankes' => 10270138
            ]);
            
            Skdr::create([
                'officer_name' => 'Rahmat',
                'week' => 16,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Morgan']),
                'kode_fasyankes' => 10270138
            ]);
            
            Skdr::create([
                'officer_name' => 'Siti',
                'week' => 18,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Morgan']),
                'kode_fasyankes' => 10270138
            ]);
            
            Skdr::create([
                'officer_name' => 'Agus',
                'week' => 20,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Andre']),
                'kode_fasyankes' => 10270138
            ]);
            
            Skdr::create([
                'officer_name' => 'Siti',
                'week' => 40,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kevin']),
                'kode_fasyankes' => 10270138
            ]);
            
            Skdr::create([
                'officer_name' => 'Lina',
                'week' => 50,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Kevin']),
                'kode_fasyankes' => 10270138
            ]);
            
            Skdr::create([
                'officer_name' => 'Dewi',
                'week' => 51,
                'year' => 2025,
                'case_count' => 1,
                'patient_names' => $formatPatientNames(['Alya']),
                'kode_fasyankes' => 10270138
            ]);
            
    }
}
