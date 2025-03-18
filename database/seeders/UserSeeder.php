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

        $dinkes = User::factory()->create([
            'name' => 'Puskesmas Sukmajaya',
            'email' => 'pkmsukmajaya@depok.go.id',
            'password' => bcrypt('decode123'),
            'kode_fasyankes' => '10270301',
        ]);
        $dinkes->assignRole($role_puskesmas);



    }
}
