<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Pustakawan',
            'level' => 'pustakawan',
            'nis_nip' => '197905012009012002',
            'password' => bcrypt('password'),
            'email' => 'pustakawan@gmail.com',
        ]);
        // User::create([
        //     'name' => 'Kepala Sekolah',
        //     'level' => 'kepsek',
        //     'nis_nip' => '196507171991031009',
        //     'password' => bcrypt('password'),
        //     'email' => 'kepsek@gmail.com',
        // ]);
        // User::create([
        //     'name' => 'Anggota Pustaka',
        //     'level' => 'anggota',
        //     'nis_nip' => '18110006',
        //     'password' => bcrypt('password'),
        //     'email' => 'anggota@gmail.com',

        // ]);
    }
}
