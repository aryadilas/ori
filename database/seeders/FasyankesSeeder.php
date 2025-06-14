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
                'kode_fasyankes' => '32760200001',
                'name' => 'SAWANGAN',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327603',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200002',
                'name' => 'DUREN SERIBU',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327611',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200003',
                'name' => 'PASIR PUTIH',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327603',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200004',
                'name' => 'KEDAUNG',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327603',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200005',
                'name' => 'PENGASINAN',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327603',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200006',
                'name' => 'BOJONGSARI',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327611',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200007',
                'name' => 'PANCORAN MAS',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327601',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200008',
                'name' => 'DEPOK JAYA',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327601',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200009',
                'name' => 'RANGKAPAN JAYA BARU',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327601',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200010',
                'name' => 'CIPAYUNG',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327607',
                'longitude' => null,
                'latitude' => null,
            ],
            // cipayung
            [
                'kode_fasyankes' => '32760200011',
                'name' => 'SUKMAJAYA',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327605',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200012',
                'name' => 'ABADIJAYA',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327605',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200013',
                'name' => 'BHAKTIJAYA',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327605',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200014',
                'name' => 'VILLA PERTIWI',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327608',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200015',
                'name' => 'KALIMULYA',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327608',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200016',
                'name' => 'PONDOK SUKMAJAYA',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327605',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200017',
                'name' => 'CILODONG',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327608',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200018',
                'name' => 'CIMANGGIS',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327602',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200019',
                'name' => 'TAPOS',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327610',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200020',
                'name' => 'SUKATANI',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327610',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200021',
                'name' => 'TUGU',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327602',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200022',
                'name' => 'JATIJAJAR',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327610',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200023',
                'name' => 'HARJAMUKTI',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327602',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200024',
                'name' => 'PASIR GUNUNG SELATAN',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327602',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200025',
                'name' => 'MEKARSARI',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327602',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200026',
                'name' => 'CILANGKAP',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327610',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200027',
                'name' => 'CIMPAEUN',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327610',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200028',
                'name' => 'BEJI',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327606',
                'longitude' => null,
                'latitude' => null,
            ],
            // beji
            [
                'kode_fasyankes' => '32760200029',
                'name' => 'TANAH BARU',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327606',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200030',
                'name' => 'KEMIRIMUKA',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327606',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200031',
                'name' => 'LIMO',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327604',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200032',
                'name' => 'CINERE',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327609',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200033',
                'name' => 'RATUJAYA',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327607',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200034',
                'name' => 'CISALAK PASAR',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327602',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200035',
                'name' => 'SUKAMAJU BARU',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327610',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200036',
                'name' => 'CINANGKA',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327603',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200037',
                'name' => 'DEPOK UTARA',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327606',
                'longitude' => null,
                'latitude' => null,
            ],
            [
                'kode_fasyankes' => '32760200038',
                'name' => 'MAMPANG',
                'type' => FasyankesType::PUSKESMAS,
                'regency_id' => '3276',
                'subdistrict_id' => '327601',
                'longitude' => null,
                'latitude' => null,
            ],




           
        ];

        foreach($fasyankes as $data){
            Fasyankes::where('kode_fasyankes', $data['kode_fasyankes'])->update($data);
        }
    
    }
}
