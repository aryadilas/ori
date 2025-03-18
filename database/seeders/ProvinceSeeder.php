<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Province;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            // [ 'id' => '', 'province_id' => '', 'name' => '', ],

            [ 'id' => '1', 'province_id' => '11', 'name' => 'ACEH', ],
            [ 'id' => '2', 'province_id' => '12', 'name' => 'SUMATERA UTARA', ],
            [ 'id' => '3', 'province_id' => '13', 'name' => 'SUMATERA BARAT', ],
            [ 'id' => '4', 'province_id' => '14', 'name' => 'RIAU', ],
            [ 'id' => '5', 'province_id' => '15', 'name' => 'JAMBI', ],
            [ 'id' => '6', 'province_id' => '16', 'name' => 'SUMATERA SELATAN', ],
            [ 'id' => '7', 'province_id' => '17', 'name' => 'BENGKULU', ],
            [ 'id' => '8', 'province_id' => '18', 'name' => 'LAMPUNG', ],
            [ 'id' => '9', 'province_id' => '19', 'name' => 'KEPULAUAN BANGKA BELITUNG', ],
            [ 'id' => '10', 'province_id' => '21', 'name' => 'KEPULAUAN RIAU', ],
            [ 'id' => '11', 'province_id' => '31', 'name' => 'DKI JAKARTA', ],
            [ 'id' => '12', 'province_id' => '32', 'name' => 'JAWA BARAT', ],
            [ 'id' => '13', 'province_id' => '33', 'name' => 'JAWA TENGAH', ],
            [ 'id' => '14', 'province_id' => '34', 'name' => 'D.I. YOGYAKARTA', ],
            [ 'id' => '15', 'province_id' => '35', 'name' => 'JAWA TIMUR', ],
            [ 'id' => '16', 'province_id' => '36', 'name' => 'BANTEN', ],
            [ 'id' => '17', 'province_id' => '51', 'name' => 'BALI', ],
            [ 'id' => '18', 'province_id' => '52', 'name' => 'NUSA TENGGARA BARAT', ],
            [ 'id' => '19', 'province_id' => '53', 'name' => 'NUSA TENGGARA TIMUR', ],
            [ 'id' => '20', 'province_id' => '61', 'name' => 'KALIMANTAN BARAT', ],
            [ 'id' => '21', 'province_id' => '62', 'name' => 'KALIMANTAN TENGAH', ],
            [ 'id' => '22', 'province_id' => '63', 'name' => 'KALIMANTAN SELATAN', ],
            [ 'id' => '23', 'province_id' => '64', 'name' => 'KALIMANTAN TIMUR', ],
            [ 'id' => '24', 'province_id' => '65', 'name' => 'KALIMANTAN UTARA', ],
            [ 'id' => '25', 'province_id' => '71', 'name' => 'SULAWESI UTARA', ],
            [ 'id' => '26', 'province_id' => '72', 'name' => 'SULAWESI TENGAH', ],
            [ 'id' => '27', 'province_id' => '73', 'name' => 'SULAWESI SELATAN', ],
            [ 'id' => '28', 'province_id' => '74', 'name' => 'SULAWESI TENGGARA', ],
            [ 'id' => '29', 'province_id' => '75', 'name' => 'GORONTALO', ],
            [ 'id' => '30', 'province_id' => '76', 'name' => 'SULAWESI BARAT', ],
            [ 'id' => '31', 'province_id' => '81', 'name' => 'MALUKU', ],
            [ 'id' => '32', 'province_id' => '82', 'name' => 'MALUKU UTARA', ],
            [ 'id' => '33', 'province_id' => '91', 'name' => 'PAPUA', ],
            [ 'id' => '34', 'province_id' => '92', 'name' => 'PAPUA BARAT', ],
            [ 'id' => '35', 'province_id' => '93', 'name' => 'PAPUA SELATAN', ],
            [ 'id' => '36', 'province_id' => '94', 'name' => 'PAPUA TENGAH', ],
            [ 'id' => '37', 'province_id' => '95', 'name' => 'PAPUA PEGUNUNGAN', ],
            [ 'id' => '38', 'province_id' => '96', 'name' => 'PAPUA BARAT DAYA', ],

        ];

        
        foreach($provinces as $province){
            Province::insert($province);
        }

    }
}
