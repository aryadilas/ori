<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $role_super_admin = Role::create(['name' => 'Super Admin']);
        $role_dinkes = Role::create(['name' => 'Dinkes']);
        $role_puskesmas = Role::create(['name' => 'Puskesmas']);
        $role_kemkes = Role::create(['name' => 'Kemkes']);

        $super_admin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@depok.go.id',
            'password' => bcrypt('decode123'),
        ]);
        $super_admin->assignRole($role_super_admin);

        $dinkes = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'dinkes@depok.go.id',
            'password' => bcrypt('KwfoaujEra'),
        ]);
        $dinkes->assignRole($role_dinkes);

        $kemkes = User::factory()->create([
            'name' => 'Admin Kemkes',
            'email' => 'kemkes@depok.go.id',
            'password' => bcrypt('KwfoaujEra'),
        ]);
        $kemkes->assignRole($role_kemkes);







        // $pkmsukmajaya = User::factory()->create([
        //     'name' => 'Puskesmas Sukmajaya',
        //     'email' => 'pkmsukmajaya@depok.go.id',
        //     'password' => bcrypt('decode123'),
        //     'kode_fasyankes' => '10270112',
        // ]);
        // $dinkes->assignRole($role_puskesmas);










        $puskesmas = [
            [
                'name' => 'SAWANGAN',
                'email' => 'sawangan@depok.go.id',
                // 'kode_fasyankes' => '10270103',
                'kode_fasyankes' => '32760200001',
            ],
            [
                'name' => 'DUREN SERIBU',
                'email' => 'durenseribu@depok.go.id',
                // 'kode_fasyankes' => '10270104',
                'kode_fasyankes' => '32760200002',
            ],
            [
                'name' => 'PASIR PUTIH',
                'email' => 'pasirputih@depok.go.id',
                // 'kode_fasyankes' => '10270105',
                'kode_fasyankes' => '32760200003',
            ],
            [
                'name' => 'KEDAUNG',
                'email' => 'kedaung@depok.go.id',
                // 'kode_fasyankes' => '10270106',
                'kode_fasyankes' => '32760200004',
            ],
            [
                'name' => 'PENGASINAN',
                'email' => 'pengasinan@depok.go.id',
                // 'kode_fasyankes' => '10270107',
                'kode_fasyankes' => '32760200005',
            ],
            [
                'name' => 'BOJONGSARI',
                'email' => 'bojongsari@depok.go.id',
                // 'kode_fasyankes' => '10270108',
                'kode_fasyankes' => '32760200006',
            ],
            [
                'name' => 'PANCORAN MAS',
                'email' => 'pancoranmas@depok.go.id',
                // 'kode_fasyankes' => '10270109',
                'kode_fasyankes' => '32760200007',
            ],
            [
                'name' => 'DEPOK JAYA',
                'email' => 'depokjaya@depok.go.id',
                // 'kode_fasyankes' => '10270110',
                'kode_fasyankes' => '32760200008',
            ],
            [
                'name' => 'RANGKAPAN JAYA BARU',
                'email' => 'rangkapanjayabaru@depok.go.id',
                // 'kode_fasyankes' => '10270111',
                'kode_fasyankes' => '32760200009',
            ],
            [
                // br
                'name' => 'CIPAYUNG',
                'email' => 'cipayung@depok.go.id',
                // 'kode_fasyankes' => '10270112',
                'kode_fasyankes' => '32760200010',
            ],
            [
                'name' => 'SUKMAJAYA',
                'email' => 'sukmajaya@depok.go.id',
                // 'kode_fasyankes' => '10270112',
                'kode_fasyankes' => '32760200011',
            ],
            [
                'name' => 'ABADIJAYA',
                'email' => 'abadijaya@depok.go.id',
                // 'kode_fasyankes' => '10270113',
                'kode_fasyankes' => '32760200012',
            ],
            [
                'name' => 'BHAKTIJAYA',
                'email' => 'bhaktijaya@depok.go.id',
                // 'kode_fasyankes' => '10270114',
                'kode_fasyankes' => '32760200013',
            ],
            [
                'name' => 'VILLA PERTIWI',
                'email' => 'villapertiwi@depok.go.id',
                // 'kode_fasyankes' => '10270115',
                'kode_fasyankes' => '32760200014',
            ],
            [
                'name' => 'KALIMULYA',
                'email' => 'kalimulya@depok.go.id',
                // 'kode_fasyankes' => '10270116',
                'kode_fasyankes' => '32760200015',
            ],
            [
                'name' => 'PONDOK SUKMAJAYA',
                'email' => 'pondoksukmajaya@depok.go.id',
                // 'kode_fasyankes' => '10270117',
                'kode_fasyankes' => '32760200016',
            ],
            [
                'name' => 'CILODONG',
                'email' => 'cilodong@depok.go.id',
                // 'kode_fasyankes' => '10270118',
                'kode_fasyankes' => '32760200017',
            ],
            [
                'name' => 'CIMANGGIS',
                'email' => 'cimanggis@depok.go.id',
                // 'kode_fasyankes' => '10270119',
                'kode_fasyankes' => '32760200018',
            ],
            [
                'name' => 'TAPOS',
                'email' => 'tapos@depok.go.id',
                // 'kode_fasyankes' => '10270120',
                'kode_fasyankes' => '32760200019',
            ],
            [
                'name' => 'SUKATANI',
                'email' => 'sukatani@depok.go.id',
                // 'kode_fasyankes' => '10270121',
                'kode_fasyankes' => '32760200020',
            ],
            [
                'name' => 'TUGU',
                'email' => 'tugu@depok.go.id',
                // 'kode_fasyankes' => '10270122',
                'kode_fasyankes' => '32760200021',
            ],
            [
                'name' => 'JATIJAJAR',
                'email' => 'jatijajar@depok.go.id',
                // 'kode_fasyankes' => '10270123',
                'kode_fasyankes' => '32760200022',
            ],
            [
                'name' => 'HARJAMUKTI',
                'email' => 'harjamukti@depok.go.id',
                // 'kode_fasyankes' => '10270124',
                'kode_fasyankes' => '32760200023',
            ],
            [
                'name' => 'PASIR GUNUNG SELATAN',
                'email' => 'pasirgunungselatan@depok.go.id',
                // 'kode_fasyankes' => '10270125',
                'kode_fasyankes' => '32760200024',
            ],
            [
                'name' => 'MEKARSARI',
                'email' => 'mekarsari@depok.go.id',
                // 'kode_fasyankes' => '10270126',
                'kode_fasyankes' => '32760200025',
            ],
            [
                'name' => 'CILANGKAP',
                'email' => 'cilangkap@depok.go.id',
                // 'kode_fasyankes' => '10270127',
                'kode_fasyankes' => '32760200026',
            ],
            [
                'name' => 'CIMPAEUN',
                'email' => 'cimpaeun@depok.go.id',
                // 'kode_fasyankes' => '10270128',
                'kode_fasyankes' => '32760200027',
            ],
            [
                // br
                'name' => 'BEJI',
                'email' => 'beji@depok.go.id',
                // 'kode_fasyankes' => '10270128',
                'kode_fasyankes' => '32760200028',
            ],
            [
                'name' => 'TANAH BARU',
                'email' => 'tanahbaru@depok.go.id',
                // 'kode_fasyankes' => '10270129',
                'kode_fasyankes' => '32760200029',
            ],
            [
                'name' => 'KEMIRIMUKA',
                'email' => 'kemirimuka@depok.go.id',
                // 'kode_fasyankes' => '10270130',
                'kode_fasyankes' => '32760200030',
            ],
            [
                'name' => 'LIMO',
                'email' => 'limo@depok.go.id',
                // 'kode_fasyankes' => '10270131',
                'kode_fasyankes' => '32760200031',
            ],
            [
                'name' => 'CINERE',
                'email' => 'cinere@depok.go.id',
                // 'kode_fasyankes' => '10270132',
                'kode_fasyankes' => '32760200032',
            ],
            // [
            //     'name' => 'CIPAYUNG',
            //     'email' => 'upkpcipayung@depok.go.id',
            //     // 'kode_fasyankes' => '10270133',
            //     'kode_fasyankes' => '10270133',
            // ],
            [
                'name' => 'RATUJAYA',
                'email' => 'ratujaya@depok.go.id',
                // 'kode_fasyankes' => '10270134',
                'kode_fasyankes' => '32760200033',
            ],
            [
                'name' => 'CISALAK PASAR',
                'email' => 'cisalakpasar@depok.go.id',
                // 'kode_fasyankes' => '10270134',
                'kode_fasyankes' => '32760200034',
            ],
    
            [
                'name' => 'SUKAMAJU BARU',
                'email' => 'sukamajubaru@depok.go.id',
                // 'kode_fasyankes' => '10270136',
                'kode_fasyankes' => '32760200035',
            ],
            [
                'name' => 'CINANGKA',
                'email' => 'cinangka@depok.go.id',
                // 'kode_fasyankes' => '10270136',
                'kode_fasyankes' => '32760200036',
            ],
            [
                'name' => 'DEPOK UTARA',
                'email' => 'depokutara@depok.go.id',
                // 'kode_fasyankes' => '10270137',
                'kode_fasyankes' => '32760200037',
            ],
            [
                'name' => 'MAMPANG',
                'email' => 'mampang@depok.go.id',
                // 'kode_fasyankes' => '10270138',
                'kode_fasyankes' => '32760200038',
            ],
        ];
        
        foreach ($puskesmas as $value) {
            $pkmUser  = User::factory()->create([
                'name' => $value['name'],
                'email' => $value['email'],
                'password' => bcrypt('decode123'),
                // // 'kode_fasyankes' => $value['kode_fasyankes'],
                'kode_fasyankes' => $value['kode_fasyankes'],
                'kode_fasyankes' => $value['kode_fasyankes'],
            ]);
            $pkmUser->assignRole($role_puskesmas);
        }












    }
}
