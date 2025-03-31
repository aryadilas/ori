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







        // $pkmsukmajaya = User::factory()->create([
        //     'name' => 'Puskesmas Sukmajaya',
        //     'email' => 'pkmsukmajaya@depok.go.id',
        //     'password' => bcrypt('decode123'),
        //     'kode_fasyankes' => '10270112',
        // ]);
        // $dinkes->assignRole($role_puskesmas);










        $puskesmas = [
            [
                'name' => 'UPT PKM KEC SAWANGAN',
                'email' => 'upkpmsawang@depok.go.id',
                'kode_fasyankes' => '10270103',
            ],
            [
                'name' => 'UPF PKM DUREN SERIBU',
                'email' => 'upfpkmduren@depok.go.id',
                'kode_fasyankes' => '10270104',
            ],
            [
                'name' => 'UPF PKM PASIR PUTIH',
                'email' => 'upfpkmpasirputih@depok.go.id',
                'kode_fasyankes' => '10270105',
            ],
            [
                'name' => 'UPF PKM KEDAUNG',
                'email' => 'upfpkmkedaung@depok.go.id',
                'kode_fasyankes' => '10270106',
            ],
            [
                'name' => 'UPF PKM PENGASINAN',
                'email' => 'upfpkmpengasinan@depok.go.id',
                'kode_fasyankes' => '10270107',
            ],
            [
                'name' => 'UPT PKM KEC BOJONGSARI',
                'email' => 'upkpmbojongsari@depok.go.id',
                'kode_fasyankes' => '10270108',
            ],
            [
                'name' => 'UPT PKM KEC PANCORAN MAS',
                'email' => 'upkpmpancoran@depok.go.id',
                'kode_fasyankes' => '10270109',
            ],
            [
                'name' => 'UPF PKM DEPOK JAYA',
                'email' => 'upfpkmdepokjaya@depok.go.id',
                'kode_fasyankes' => '10270110',
            ],
            [
                'name' => 'UPF PKM RANGKAPAN JAYA BARU',
                'email' => 'upfpkmrangkapanjaya@depok.go.id',
                'kode_fasyankes' => '10270111',
            ],
            [
                'name' => 'UPT PKM KEC SUKMAJAYA',
                'email' => 'upkpmsukmajaya@depok.go.id',
                'kode_fasyankes' => '10270112',
            ],
            [
                'name' => 'UPF PKM ABADIJAYA',
                'email' => 'upfpkmabadijaya@depok.go.id',
                'kode_fasyankes' => '10270113',
            ],
            [
                'name' => 'UPF PKM BHAKTIJAYA',
                'email' => 'upfpkmbhaktijaya@depok.go.id',
                'kode_fasyankes' => '10270114',
            ],
            [
                'name' => 'UPF PKM VILLA PERTIWI',
                'email' => 'upfpkmvillapertiwi@depok.go.id',
                'kode_fasyankes' => '10270115',
            ],
            [
                'name' => 'UPF PKM KALIMULYA',
                'email' => 'upfpkmkalimulya@depok.go.id',
                'kode_fasyankes' => '10270116',
            ],
            [
                'name' => 'UPF PKM PONDOK SUKMAJAYA',
                'email' => 'upfpkmpondoksukmajaya@depok.go.id',
                'kode_fasyankes' => '10270117',
            ],
            [
                'name' => 'UPT PKM KEC CILODONG',
                'email' => 'upkpcilodong@depok.go.id',
                'kode_fasyankes' => '10270118',
            ],
            [
                'name' => 'UPT PKM KEC CIMANGGIS',
                'email' => 'upkpcimanggis@depok.go.id',
                'kode_fasyankes' => '10270119',
            ],
            [
                'name' => 'UPT PKM KEC TAPOS',
                'email' => 'upkptapos@depok.go.id',
                'kode_fasyankes' => '10270120',
            ],
            [
                'name' => 'UPF PKM SUKATANI',
                'email' => 'upfpkmsukatani@depok.go.id',
                'kode_fasyankes' => '10270121',
            ],
            [
                'name' => 'UPF PKM TUGU',
                'email' => 'upfpkmtugu@depok.go.id',
                'kode_fasyankes' => '10270122',
            ],
            [
                'name' => 'UPF PKM JATIJAJAR',
                'email' => 'upfpkmjatijajar@depok.go.id',
                'kode_fasyankes' => '10270123',
            ],
            [
                'name' => 'UPF PKM HARJAMUKTI',
                'email' => 'upfpkmharjamukti@depok.go.id',
                'kode_fasyankes' => '10270124',
            ],
            [
                'name' => 'UPF PKM PASIR GUNUNG SELATAN',
                'email' => 'upfpkmpasirgunsel@depok.go.id',
                'kode_fasyankes' => '10270125',
            ],
            [
                'name' => 'UPF PKM MEKARSARI',
                'email' => 'upfpkmmekarsari@depok.go.id',
                'kode_fasyankes' => '10270126',
            ],
            [
                'name' => 'UPF PKM CILANGKAP',
                'email' => 'upfpkmcilangkap@depok.go.id',
                'kode_fasyankes' => '10270127',
            ],
            [
                'name' => 'UPF PKM CIMPAEUN',
                'email' => 'upfpkmcimpaeun@depok.go.id',
                'kode_fasyankes' => '10270128',
            ],
            [
                'name' => 'UPF PKM TANAH BARU',
                'email' => 'upfpkmtanahbaru@depok.go.id',
                'kode_fasyankes' => '10270129',
            ],
            [
                'name' => 'UPF PKM KEMIRIMUKA',
                'email' => 'upfpkmkemirimuka@depok.go.id',
                'kode_fasyankes' => '10270130',
            ],
            [
                'name' => 'UPT PKM KEC L I M O',
                'email' => 'upkplimo@depok.go.id',
                'kode_fasyankes' => '10270131',
            ],
            [
                'name' => 'UPT PKM KEC CINERE',
                'email' => 'upkpcinere@depok.go.id',
                'kode_fasyankes' => '10270132',
            ],
            [
                'name' => 'UPT PKM KEC CIPAYUNG',
                'email' => 'upkpcipayung@depok.go.id',
                'kode_fasyankes' => '10270133',
            ],
            [
                'name' => 'UPF PKM CISALAK PASAR',
                'email' => 'upfpkmcisalakpasar@depok.go.id',
                'kode_fasyankes' => '10270134',
            ],
            [
                'name' => 'UPF PKM RATU JAYA',
                'email' => 'upfpkmratujaya@depok.go.id',
                'kode_fasyankes' => '10270135',
            ],
            [
                'name' => 'UPF PKM SUKAMAJU BARU',
                'email' => 'upfpkmsukamajubaru@depok.go.id',
                'kode_fasyankes' => '10270136',
            ],
            [
                'name' => 'UPF DEPOK UTARA',
                'email' => 'upfpkmdepokutara@depok.go.id',
                'kode_fasyankes' => '10270137',
            ],
            [
                'name' => 'UPF MAMPANG',
                'email' => 'upfpkmmampang@depok.go.id',
                'kode_fasyankes' => '10270138',
            ],
        ];
        
        foreach ($puskesmas as $value) {
            $pkmUser  = User::factory()->create([
                'name' => $value['name'],
                'email' => $value['email'],
                'password' => bcrypt('decode123'),
                'kode_fasyankes' => $value['kode_fasyankes'],
            ]);
            $pkmUser->assignRole($role_puskesmas);
        }












    }
}
