<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fasyankes;
use App\Enums\FasyankesType;

class FasyankesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $fasyankes = [
            [
                'kode_fasyankes' => '10270102',
                'name' => 'Puskesmas Depok Jaya',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'longitude' => '106.81861',
                'latitude' => '-6.4025',
            ],
            [
                'kode_fasyankes' => '10270103',
                'name' => 'Puskesmas Rangkapan Jaya',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'longitude' => '106.82542',
                'latitude' => '-6.3847',
            ],
            [
                'kode_fasyankes' => '10270104',
                'name' => 'Puskesmas Cipayung',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'longitude' => '106.83921',
                'latitude' => '-6.3821',
            ],
            [
                'kode_fasyankes' => '10270203',
                'name' => 'Puskesmas Tanah Baru',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'longitude' => '106.79931',
                'latitude' => '-6.3742',
            ],
            [
                'kode_fasyankes' => '10270301',
                'name' => 'Puskesmas Sukmajaya',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'longitude' => '106.81091',
                'latitude' => '-6.3903',
            ],
            [
                'kode_fasyankes' => '10270201',
                'name' => 'Puskesmas Beji',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'longitude' => '106.80451',
                'latitude' => '-6.3749',
            ],
            [
                'kode_fasyankes' => '01380001',
                'name' => 'Puskesmas Pasir Putih',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'longitude' => '106.86401',
                'latitude' => '-6.4657',
            ],
            [
                'kode_fasyankes' => '10270101',
                'name' => 'Puskesmas Pancoran Mas',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'longitude' => '106.81621',
                'latitude' => '-6.3914',
            ],
            [
                'kode_fasyankes' => '10270202',
                'name' => 'Puskesmas Kemiri Muka',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'longitude' => '106.81231',
                'latitude' => '-6.3795',
            ],
            [
                'kode_fasyankes' => '10270302',
                'name' => 'Puskesmas Abadi Jaya',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'longitude' => '106.82041',
                'latitude' => '-6.3956',
            ],
        ];

        foreach($fasyankes as $data){
            Fasyankes::create($data);
        }
    
    }
}
